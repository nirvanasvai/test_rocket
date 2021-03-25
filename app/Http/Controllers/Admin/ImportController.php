<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use Illuminate\Support\Str;
use App\Models\Product;
use Zip;
use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ImportController extends Controller
{

    public function importExcel(Request $request)
    {
        $request->validate([
                'file' => 'required|file|mimes:xlsx|max:20480',
            ], [
                'file.max' => 'Размер файла не может быть более 20 Мегабайтов.',
                'file.required' => 'Выберите файл.',
                'file.mimes' => 'Выберите файл excel'
            ]);

        $array = Excel::toArray(new ProductImport, request()->file('file'));
        $i= 0;
        $errors=0;
        foreach ($array[0] as $item) {
            set_time_limit(10);
            try {
                $product = new Product();
                $product->article = $item['artikul'];
                $product->name = $item['naimenovanie'];
                $product->description = $item['opisanie'];
                $product->brand_id = $item['id_brenda'];
                $product->color_id = $item['id_cveta'];
                $product->category_id = $item['id_kategorii'];
                $product->price = $item['cena'];
                $product->slug = Str::slug($item['naimenovanie']);
                $product->status = 0;
                $product->save();
                $i++;
            } catch (\Exception $e) {
                $errors++;
            }
        }
        return redirect('/admin/product')->with('success', 'Файл успешно импортирован! Загружено '.$i.', не загужено '.$errors);
    }

    public function importZip(Request $request)
    {
        if ($request->post()) {

            $request->validate([
                'file' => 'required|file|mimes:zip|max:20480',
            ], [
                'file.max' => 'Размер файла не может быть более 20 Мегабайтов.',
                'file.required' => 'Выберите файл.',
                'file.mimes' => 'Выберите файл zip'
            ]);

            $uploadedFilePath = $request->file('file')->getRealPath();

            if (!Zip::check($uploadedFilePath)) {
                return redirect()->back()->withErrors(['file' => 'Недействительный ZIP']);
            }

            $zip = Zip::open($uploadedFilePath);
            $zipContent = $zip->listFiles();

            $files = [];
            $allFiles = [];
            $codes = [];
            $mot_product = '';
            $data['changed_count'] = 0;

            foreach ($zipContent as $file) {

                $zip->setMask(0755);

                if (Str::contains('/', $file) || !preg_match('/\.[a-z]+$/', $file)) continue;

                $array = explode('.', $file);
                $ext = end($array);

                if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
                    $code = preg_replace('/(-[0-9]+)?(\.[a-z]+$)/', '', $file);

                    $path_test = public_path('/storage/test/');
                    $path_extract = public_path('/storage/zip_extract/');

                    $zip->extract($path_extract, $file);

                    $ext = preg_replace('/^.*\.([^.]+)$/', '$1', $file);

                    $filename = Str::random(28).'.'.$ext;

                    $product = Product::where('article', $code)->first();
                    if($product){

                        rename($path_extract . $file, $path_test . $filename);

                        $item = new Image();

                        $item->product_article = $product->article;
                        $item->product_id = $product->id;
                        $item->image = $filename;

                        $item->save();

                        $data['changed_count']++;

                    }else{
                        $mot_product .= $code.', ';
                    }

                    File::deleteDirectory($path_extract);
                }
            }
            $mot_product = mb_substr($mot_product, 0, -2);
        }
        return redirect()->back()->with('success', 'Загружено '. $data['changed_count']. ' изображения из '.count($zipContent). '. Несоответствующие изображения: '.$mot_product);
    }

}
