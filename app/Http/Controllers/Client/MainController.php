<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Filters\ProductFilterService;
use App\Services\Site\MainService;
use Illuminate\Http\Request;
use App\Services\Site\CategoryService;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    private $MainService;

    public function __construct(){
        $this->MainService=new MainService();
    }

    public function show(){
        $data=$this->MainService->getALlPageData();
        return view('site.main',$data);
    }
}
