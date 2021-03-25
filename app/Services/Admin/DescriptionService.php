<?php
namespace App\Services\Admin;

use App\Models\Description;
use App\Services\ImageUploaderServices;

class DescriptionService {

    private $imageUploader;

    public function __construct(){

        $this->imageUploader=new ImageUploaderServices();
    }

    public function create($data)
    {
        if(isset($data['image']))
        {
            $data['image']=$this->imageUploader
                ->save('/des',$data['image'])
                ->getPath();
        }
        if(isset($data['main_image']))
        {
            $data['main_image']=$this->imageUploader
                ->save('/des',$data['main_image'])
                ->getPath();
        }
        Description::create($data);
    }
}
?>


