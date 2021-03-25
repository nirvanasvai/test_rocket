<?php
namespace App\Services\Admin;

use App\Models\SliderMain;
use App\Services\ImageUploaderServices;

class SliderService{

    private $imageUploader;

    public function __construct(){

        $this->imageUploader=new ImageUploaderServices();
    }

    public function create($data)
    {
        if(isset($data['image']))
        {
            $data['image']=$this->imageUploader
                ->save('/main',$data['image'])
                ->getPath();
        }
        SliderMain::query()->create($data);
    }
}
?>


