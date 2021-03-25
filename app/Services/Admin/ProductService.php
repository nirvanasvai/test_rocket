<?php
namespace App\Services\Admin;

use App\Services\ImageUploaderServices;

class ProductService {

    private $imageUploader;

    public function __construct(){
        $this->imageUploader=new ImageUploaderServices();
    }

    public function addImages($request){
        if(!empty($request->image)){
            foreach ($request->image as $image)
            {
                $ar[] = [
                    'image' => $this->imageUploader
                        ->save('/product', $image)
                        ->getPath(),
                ];
            }
        }
        return $ar;
    }
}
?>
