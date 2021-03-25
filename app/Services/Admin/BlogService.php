<?php
namespace App\Services\Admin;

use App\Models\Blog;
use App\Services\ImageUploaderServices;

class BlogService {

    private $imageUploader;

    public function __construct(){

        $this->imageUploader=new ImageUploaderServices();
    }

    public function create($data)
    {
        if(isset($data['image']))
        {
            $data['image']=$this->imageUploader
                ->save('/blog',$data['image'])
                ->getPath();
        }
        if(isset($data['icon']))
        {
            $data['icon']=$this->imageUploader
                ->save('/blog',$data['image'])
                ->getPath();
        }

        Blog::create($data);
    }
}
?>


