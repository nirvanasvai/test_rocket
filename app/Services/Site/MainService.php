<?php

namespace App\Services\Site;

use App\Models\About;
use App\Models\Brand;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Description;
use App\Models\Service;
use App\Models\SliderMain;

class MainService
{
    public function getALlPageData()
    {

        $data['about_page'] = About::query()->where('page_type', 0)->first();
        $data['sales_page'] = About::query()->where('page_type', 1)->first();
        $data['brands_page'] = About::query()->where('page_type', 2)->first();
        $data['service_page'] = About::query()->where('page_type', 3)->first();
        $data['partners_page'] = About::query()->where('page_type', 4)->first();
        $data['blog_info'] = About::query()->where('page_type', 6)->first();
        $data['brands']= Brand::query()->get();
        $data['services']=Service::query()->limit(4)->get();
        $data['sliders']=SliderMain::query()->get();
        $data['descriptions']=Description::query()->limit(3)->get();

        $data['mains'] = Category::query()->where('parent_id')->get();

        return $data;
    }
}
?>
