<?php

namespace App\Services\Site;



use App\Models\Banner;
use App\Models\About;
use App\Models\Service;

class ServiceService
{
    public function getALlPagedata()
    {
        $data['blogs']= About::query()->orderBy('page_type','ASC')->where('page_type', '!=', 6)->where('page_type', '!=', 5)->get();
        $data['service'] = Service::query()->get();
        $data['service_title'] = Service::query()->first();
        $data['blog_info'] = About::where('page_type', 3)->first();
        $data['advertising_banner'] = Banner::first();
        return $data;

    }
}
?>
