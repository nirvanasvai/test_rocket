<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Site\AboutService;


class AboutController extends Controller
{
    private $AboutService;

    public function __construct(){
        $this->AboutService=new AboutService();
    }

    public function show(){
        $data=$this->AboutService->getALlPageData();
        return view('site.about_us',$data);
    }
}
