<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Country;
use Illuminate\Http\Request;

class CriterionController extends Controller
{
    public function index()
    {
        return view('admin.criterion.index',
        [
            'countries'=>Country::query()->get(),
            'colors'=>Color::query()->get(),
            'brands'=>Brand::query()->get(),
        ]);
    }
}
