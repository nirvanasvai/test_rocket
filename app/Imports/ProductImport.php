<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToModel, WithHeadingRow
{
	public function model(array $rows)
    {
        
    }
}