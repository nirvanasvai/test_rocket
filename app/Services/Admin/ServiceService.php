<?php
namespace App\Services\Admin;

use App\Models\Service;
use App\Models\SliderMain;
use App\Services\ImageUploaderServices;

class ServiceService{

    private $imageUploader;

    public function __construct(){

        $this->imageUploader=new ImageUploaderServices();
    }

    public function create($data)
    {
        if(isset($data['image']))
        {
            $data['image']=$this->imageUploader
                ->save('/service',$data['image'])
                ->getPath();
        }
        if(isset($data['main_image']))
        {
            $data['main_image']=$this->imageUploader
                ->save('/service',$data['main_image'])
                ->getPath();
        }

        Service::query()->create($data);
    }
}
?>


