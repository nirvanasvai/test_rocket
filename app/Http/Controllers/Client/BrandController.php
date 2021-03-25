<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Site\BlogInnerService;
use App\Services\Site\BrandService;


class BrandController extends Controller
{
    private $BrandService;

    public function __construct(){
        $this->BrandService=new BrandService();
    }

    public function show(){
        $data=$this->BrandService->getALlPageData();
        return view('site.partners.partners',$data);
    }
    public function showInner($slug){
        $data=$this->BrandService->getALlPagedataInner($slug);
        return view('site.partners.partners_inner',$data);
    }
}
