<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;

class ImageUploaderServices{

    private $path;

    public function save($folder,$image){
        $path=Storage::putFile($folder, $image);
        $this->path=$path;
        return $this;
    }

    public function getPath(){
        return $this->path;
    }
}

?>
