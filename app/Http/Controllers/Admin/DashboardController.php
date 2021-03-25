<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallBack;
use App\Models\CallBackUrl;
use App\Services\Admin\AdminService;
use App\Services\Site\AboutService;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }
    public function orders(){
        return view('admin.call.dashboard',[
           'callback'=>CallBack::query()->orderBy('id','DESC')->get(),
            'callUrl'=>CallBackUrl::query()->orderBy('id','DESC')->get()
        ]);
    }
}

