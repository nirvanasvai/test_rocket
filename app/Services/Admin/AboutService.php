<?php
namespace App\Services\Admin;

use App\Models\About;
use App\Services\ImageUploaderServices;
use Illuminate\Support\Str;

class AboutService {

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
        if(isset($data['icon']))
        {
            $data['icon']=$this->imageUploader
                ->save('/about/icon',$data['icon'])
                ->getPath();
        }
        if(!$data['slug']){
            $data['slug'] = Str::slug($data['title_name']);
        }
        About::create($data);
    }
}
?>

