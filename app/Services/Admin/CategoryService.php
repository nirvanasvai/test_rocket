<?php
namespace App\Services\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Services\ImageUploaderServices;

class CategoryService {

    private $imageUploader;

    public function __construct(){

        $this->imageUploader=new ImageUploaderServices();
    }

    public function create($data)
    {
        if(isset($data['image']))
        {
            $data['image']=$this->imageUploader
                ->save('/cat',$data['image'])
                ->getPath();
        }
        Category::create($data);
    }
}
?>
