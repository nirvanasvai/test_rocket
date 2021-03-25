<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Site\MainService;
use App\Services\Site\ProductInnerService;
use App\Services\Site\ServiceService;
use Illuminate\Http\Request;
use App\Models\About;

class ServiceController extends Controller
{
    private $Service;

    public function __construct(){
        $this->Service=new ServiceService();
    }

    public function show(){

        $data=$this->Service->getALlPageData();
        return view('site.blog.service', $data);
    }
}
