<?php


namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Str;
use Intervention\Image\ImageManagerStatic as Image;

class ImageUpload
{
    public $width = null;
    public $height = null;
    public $path;
    public $pathMin;
    public $nameFile;

    public function width($var)
    {
        $this->width = $var;
        return $this;
    }

    public function height($var)
    {
        $this->height = $var;
        return $this;
    }
    public function path($var)
    {
        $this->path = $var;
        return $this;
    }
    public function pathMin($var)
    {
        $this->pathMin = $var;
        return $this;
    }
    public function nameFile($var)
    {
        $this->nameFile = $var;
        return $this;
    }

    public function edit($image)
    {
        if($image->getWidth() > $this->width) Image::make(storage_path($this->path))->resize($this->width, $this->height, function ($constraint) {$constraint->aspectRatio();})->save();
        Image::make(storage_path($this->pathMin))->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->save();
        // resize the image to a width of 300 and constrain aspect ratio (auto height)
        return true;
    }

    public function upload($request)
    {
        if ($request->image) {
            # code...


            foreach ($request->image as $ph)
            {

                // $this->path = $ph->store($this->path);
                // $this->path = 'app/public/' . $this->path;

                // $nameImg = explode("/", $this->path);
                // $nameImg = end($nameImg);
                // $this->pathMin = $ph->store($this->pathMin);
                // $this->pathMin = 'app/public/' . $this->pathMin;
                // $image = Image::make(storage_path($this->path));
                // $this->edit($image);
                // $ar[] = $nameImg;

                $folder = 'test';
                $name = Str::random(25);
                $file = $ph->storeAs($folder, $name.'.'.$ph->getClientOriginalExtension());
                $test_img[] = $name.'.'.$ph->getClientOriginalExtension();
            }

            return $test_img;
        }
    }

    public function deleteAll($images)
    {
        foreach ($images as $image)
        {
            Storage::delete($this->path.$image->image);
            Storage::delete($this->pathMin.$image->image);
        }
    }
    public function deleteOne($image)
    {
        Storage::delete($this->path.$image->image);
        Storage::delete($this->pathMin.$image->image);
    }


}
