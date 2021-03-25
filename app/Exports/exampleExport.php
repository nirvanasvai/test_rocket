<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\ProductsSheet;
use App\Exports\Sheets\CategoriesSheet;
use App\Exports\Sheets\BrandsSheet;
use App\Exports\Sheets\ColorsSheet;

class exampleExport implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets['products'] = new ProductsSheet();
        $sheets['categories'] = new CategoriesSheet();
        $sheets['brands'] = new BrandsSheet();
        $sheets['colors'] = new ColorsSheet();
        return $sheets;
    }
}