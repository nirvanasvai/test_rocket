<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Filter;
use App\Models\FilterItem;
use App\Models\FiltersRelations;
use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
use App\Services\Admin\ProductService;
use App\Services\Filters\ProductFilterService;
use App\Services\ImageUpload;
use App\Services\ImageUploaderServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Translation\Dumper\PoFileDumper;
use Intervention\Image\ImageManager;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(ProductFilterService $filters, Request $request)
    {
        $data = $request->all();
        $categories = Category::orderBy('title', 'DESC')->whereNull('parent_id')->get();
        if($request->input('paginate')){
            $paginate = $request->get('paginate');
        }else{
            $paginate = 50;
        }

        if($request->input('category_id')){
            $products = Product::where('category_id', $request->get('category_id'))->paginate($paginate)->withQueryString();;
        }
        else{
            $products = Product::query()
            ->filter($filters)
            ->paginate($paginate)->withQueryString();;
        }
        return view('admin.product.index',
            compact('products', 'categories', 'data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role!=2)
            return redirect('admin/product')->with('warning','У вас нет прав в данный раздел!');

        return view('admin.product.create',[
            'brands'=>Brand::query()->get(),
            'colors'=>Color::query()->get(),
            'countries'=>Country::query()->get(),
            'categories' => Category::whereNULL('parent_id')->get(),
            'delimiter'  => '',
            'filters'=>Filter::query()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(ProductRequest $request, ImageUpload $image)
    {

        $product = (new Product)->addProduct($request);

        $arImage = $image->width(1200)
            ->path('/test')
            ->pathMin('/test')
            ->upload($request);

        if ($arImage) {
            (new Image)
                ->addImage($arImage, $product->id);
        }
        if($request->input('categories')) :
            $product->categories()->attach($request->input('categories'));
        endif;

        $data = $request->all();
        if (isset($data['filters'])){
            foreach ($data['filters'] as $key => $item) {
                $filter = new FiltersRelations();
                $filter->product_id = $product->id;
                $filter->filter_id = $item;
                $filter->save();
            }
        }
        if (isset($data['features_id'])) {
            foreach ($data['features_id'] as $items) {

                $feature = Feature::where('id', intval($items))->first();
                $title = $data['test']['title'][$items];
                $title_name = $data['test']['title_name'][$items];
                ;

                if (isset($data['test']['icon'][$items])) {
                    $folder = 'features';
                    $filename = null;
                    $name = !is_null($filename) ? $filename : Str::random(25);
                    $file = $data['test']['icon'][$items]->storeAs($folder, $name.'.'.$data['test']['icon'][$items]->getClientOriginalExtension());
                    $icon = $name.'.'.$data['test']['icon'][$items]->getClientOriginalExtension();
                    $feature->icon = '/features/'.$icon;
                }

                $feature->product_id = $product->id;
                $feature->title = $title;
                $feature->title_name = $title_name;

                $feature->save();
            }
        }


        return redirect('admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filter_arr = [];
        $filters_id = [];
        $product = Product::with('colors')->where('id', $id)->first();
        $find_category = Category::find($product->category_id);
        if ($find_category && $find_category->filters != NULL) {
            $filters_id = array_merge($filter_arr,json_decode($find_category->filters));
        }

        if($find_category->parent_id != NULL){
            $parent_category = Category::find($find_category->parent_id);

            if($parent_category->filters != NULL){
                $filters_id = array_merge($filter_arr, json_decode($parent_category->filters));
            }
        }
        if ($filters_id != NULL) {

            array_unique($filters_id);
            $filters = Filter::query()->whereIn('id', $filters_id)->get();
        }else{
            $filters = NULL;
        }

        $relations = FiltersRelations::where('product_id', $id)->select('filter_id')->get()->toArray();

        if($relations){
            foreach($relations as $item){
                $relation[] = $item['filter_id'];
            }
        }else{
            $relation[] = [];
        }

        $feature = Feature::where('product_id', $id)->get();
        return view('admin.product.edit',compact('product', 'feature', 'relation'),[
            'brands'=>Brand::query()
                ->get(),
            'colors'=>Color::query()
                ->get(),
            'countries'=>Country::query()
                ->get(),
            'categories'=>Category::query()->get(),
            'filters'=> $filters,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(ProductRequest $request,ImageUpload $image, $id)
    {
        $product = (new Product)->updateProduct($request, $id);

        $arImage = $image->width(1200)
            ->upload($request);

        if ($arImage) {
            (new Image)->addImage($arImage, $product->id, $product->article);
        }


        $data = $request->all();

        if($request->input('filters')){
            $pluck = FiltersRelations::where('product_id', $id)->pluck('id')->toArray();

            foreach ($pluck as $item){
                if(!in_array($item, $data['filters'])){
                    $delete_filter = FiltersRelations::where('id', $item)->where('product_id', $product->id)->first();
                    $delete_filter->delete();
                }
            }

            foreach ($data['filters'] as $key => $item) {
                $check_filter = FiltersRelations::where('filter_id', $item)->where('product_id', $product->id)->first();

                if (!$check_filter) {
                    $filter = new FiltersRelations();
                    $filter->product_id = $product->id;
                    $filter->filter_id = $item;
                    $filter->save();
                    if ($request->input('filters')) {
                        foreach ($data['filters'] as $key => $item) {
                            $check_filter = FiltersRelations::where('filter_id', $item)->where('product_id', $product->id)->first();

                            if (!$check_filter) {
                                $filter = new FiltersRelations();
                                $filter->product_id = $product->id;
                                $filter->filter_id = $item;
                                $filter->save();
                            }
                        }
                    }


                    if (isset($data['features_id'])) {
                        foreach ($data['features_id'] as $items) {

                            $feature = Feature::where('id', intval($items))->first();
                            $title = $data['test']['title'][$items];
                            $title_name = $data['test']['title_name'][$items];

                            if (isset($data['test']['icon'][$items])) {
                                $folder = 'features';
                                $filename = null;
                                $name = !is_null($filename) ? $filename : Str::random(25);
                                $file = $data['test']['icon'][$items]->storeAs($folder, $name . '.' . $data['test']['icon'][$items]->getClientOriginalExtension());
                                $icon = $name . '.' . $data['test']['icon'][$items]->getClientOriginalExtension();
                                $feature->icon = '/features/' . $icon;
                            }

                            $feature->product_id = $id;
                            $feature->title = $title;
                            $feature->title_name = $title_name;

                            $feature->save();
                        }
                    }
                }
            }

        }else{
            $pluck = FiltersRelations::where('product_id', $id)->get();
            foreach ($pluck as $item){
                $item->delete();
            }
        }

        if (isset($data['features_id'])) {
            foreach ($data['features_id'] as $items) {

                $feature = Feature::where('id', intval($items))->first();
                $title = $data['test']['title'][$items];
                $title_name = $data['test']['title_name'][$items];

                if (isset($data['test']['icon'][$items])) {
                    $folder = 'features';
                    $filename = null;
                    $name = !is_null($filename) ? $filename : Str::random(25);
                    $file = $data['test']['icon'][$items]->storeAs($folder, $name.'.'.$data['test']['icon'][$items]->getClientOriginalExtension());
                    $icon = $name.'.'.$data['test']['icon'][$items]->getClientOriginalExtension();
                    $feature->icon = '/features/'.$icon;
                }

                $feature->product_id = $id;
                $feature->title = $title;
                $feature->title_name = $title_name;

                $feature->save();
            }
        }

        return redirect('admin/product')->with('success','Успешно!');

    }
    public function deleteImage($id, ImageUpload $imageUpload)
    {
        $image = Image::query()->find($id);
        $imageUpload->path('/product/images/')
            ->pathMin('/product/images_min/')
            ->deleteOne($image);
        $image->delete();
        return redirect()->back();
    }

    public function destroy($id, ImageUpload $imageUpload)
    {
        $product = Product::query()->find($id);
        $imageUpload->path('/product/images/')
            ->pathMin('/product/images_min/')
            ->deleteAll($product->childrenImg);
        $product->childrenImg()->delete();
        $product->delete();
        return redirect()->back();
    }

    public function featureAdd(Request $request)
    {
        $featureData = $request->all();
        $feature = new Feature();
        $feature->save();
        return $feature->id;
    }
    public function featureRemove(Request $request)
    {
        $featureData = $request->all();
        $feature = Feature::findOrFail($featureData['id']);
        if($feature->delete()){
            return 1;
        }else{
            return 0;
        }

    }

    public function apiDeletePosition($id)
    {
        $result = false;

        $position = FilterItem::find($id);
        if ($position){
            $result = true;
        }

        return $result;
    }

    public function apiUpdateStatus(Request $request)
    {
        $requestData = $request->all();
        if($requestData['type'] == 'category'){
            $data = Category::find($requestData['id']);
            $data->status = $requestData['status'];
            $data->update();
        }
        if($requestData['type'] == 'product'){
            $data = Product::find($requestData['id']);
            $data->status = $requestData['status'];
            $data->update();
        }
        if($requestData['type'] == 'review'){
            $data = Review::find($requestData['id']);
            $data->status = $requestData['status'];
            $data->update();
        }

        return true;
    }



    public function import()
    {
        return view('admin.product.import');
    }
    public function importZip()
    {
        return view('admin.product.import-zip');
    }
}
