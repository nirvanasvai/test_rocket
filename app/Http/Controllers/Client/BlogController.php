<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Site\BlogService;


class BlogController extends Controller
{
    private $BlogService;

    public function __construct(){
        $this->BlogService=new BlogService();
    }

    public function show(){
        $data=$this->BlogService->getALlPageData();
        return view('site.blog.saidebar',$data);
    }
}
