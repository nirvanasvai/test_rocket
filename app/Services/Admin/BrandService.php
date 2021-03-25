<?php
namespace App\Services\Admin;

use App\Models\Brand;
use App\Services\ImageUploaderServices;

class BrandService {

    private $imageUploader;

    public function __construct(){

        $this->imageUploader=new ImageUploaderServices();
    }

    public function create($data)
    {
        if(isset($data['image']))
        {
            $data['image']=$this->imageUploader
                ->save('/about',$data['image'])
                ->getPath();
        }
        Brand::create($data);
    }
}
?>
