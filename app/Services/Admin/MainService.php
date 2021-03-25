<?php
namespace App\Services\Admin;

use App\Models\Main;
use App\Services\ImageUploaderServices;

class MainService {

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
        Main::create($data);
    }
}
?>


