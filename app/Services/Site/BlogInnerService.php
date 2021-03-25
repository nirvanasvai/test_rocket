<?php

namespace App\Services\Site;



use App\Models\Blog;
use App\Models\Banner;

class BlogInnerService
{
    public function getALlPagedata()
    {
        $data['blogs']= Blog::query()->where('page_type', 0)->get();
        if(!$data['blogs']){
            abort(404);
        }
        $data['blog_info'] = Blog::get();
        if(!$data['blog_info']){
            abort(404);
        }
        $data['blog']= Blog::first();
        $data['advertising_banner'] = Banner::first();
        return $data;

    }
}
?>
