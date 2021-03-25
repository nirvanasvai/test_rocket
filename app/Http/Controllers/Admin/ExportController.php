<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\exampleExport;
use Illuminate\Support\Str;
use App\Models\Product;
use Zip;
use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ExportController extends Controller
{

    public function exportExcel(Request $request)
    {
        return (new exampleExport())->download('Образец_товаров.xlsx');
    }
}
