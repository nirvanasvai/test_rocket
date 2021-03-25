<?php

namespace App\Services\Site;

use App\Models\About;
use App\Models\AboutGallery;
use App\Models\Banner;

class AboutService
{
    public function getALlPagedata()
    {
        $data['abouts'] = About::query()->first();
        $data['galleries'] = AboutGallery::query()->orderBy('id', 'DESC')->get();
        $data['blogs']= About::query()->orderBy('page_type', 'ASC')->where('page_type', '!=', 6)->where('page_type', '!=', 5)->get();
        $data['advertising_banner'] = Banner::first();
        return $data;

    }
}
?>
