<?php
namespace App\Services\Admin;


use App\Models\AboutGallery;
use App\Services\ImageUploaderServices;

class AboutImagesService {

    private $imageUploader;

    public function __construct()
    {
        $this->imageUploader=new ImageUploaderServices();
    }


    public function create($request)
    {
        if(!empty($request->image))
        {
            foreach ($request->image as $image)
            {
                $ar[] =
                    [
                    'image' => $this->imageUploader
                        ->save('/about', $image)
                        ->getPath(),
                    ];
            }
        }
        AboutGallery::create($ar);
    }
}
?>
