<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Site\ContactService;


class ContactController extends Controller
{
    private $ContactService;

    public function __construct(){
        $this->ContactService=new ContactService();
    }

    public function show(){
        $data=$this->ContactService->getALlPageData();
        return view('site.contact',$data);
    }
}
