<?php

namespace App\Services\Site;



use App\Models\Blog;
use App\Models\About;

class BlogService
{
    public function getALlPagedata()
    {
        $data['blogs'] = Blog::query()->get();
        $data['blogsMobile'] = Blog::query()->first();
        $data['sales'] = About::where('page_type', 1)->first();
        if(!$data['blogs']){
            abort(404);
        }

        return $data;

    }
}
?>
