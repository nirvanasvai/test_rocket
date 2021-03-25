<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Site\MainService;
use App\Services\Site\ProductInnerService;
use Illuminate\Http\Request;

class ProductInnerController extends Controller
{
    private $ProductInnerService;

    public function __construct(){
        $this->ProductInnerService=new ProductInnerService();
    }

    public function show($slug){
        $data=$this->ProductInnerService->getALlPageData($slug);
        if ($data['products']->status == 1) {
            return view('site.product_inner', $data);
        }else
            return redirect()->back();

    }
}
