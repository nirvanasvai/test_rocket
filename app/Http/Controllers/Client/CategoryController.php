<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Filters\ProductFilterService;
use Illuminate\Http\Request;
use App\Services\Site\CategoryService;

class CategoryController extends Controller
{
    private $CategoryService;

    public function __construct(){
        $this->CategoryService=new CategoryService();
    }

    public function show(ProductFilterService $filters,Request $request, $slug){
        $data=$this->CategoryService->getAllPageData($filters,$slug);
        return view('site.catalog',$data);
    }

    public function showCatalog(ProductFilterService $filters,Request $request,$slug){
        $data=$this->CategoryService->getAllPageData($filters,$slug, $sub_category = NULL);
        return view('site.catalog',$data);
    }

    public function showSubCatalog(ProductFilterService $filters,Request $request,$category, $sub_category){
        $data=$this->CategoryService->getAllPageData($filters,$category, $sub_category,);
        return view('site.catalog',$data);
    }
}
