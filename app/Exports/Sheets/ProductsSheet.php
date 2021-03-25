<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Product;

class ProductsSheet implements FromQuery, WithTitle, ShouldAutoSize, WithHeadings
{

    public function headings(): array
    {
        return [
           'Наименование','Артикул', 'Описание', 'Цена', 'ID Цвета','ID Бренда','ID Категории'
        ];
    }

    public function query()
    {
            $data = Product::query()->select('name','article','description', 'price', 'color_id','brand_id','category_id')->limit(5);
            return $data;
        }

    public function title(): string
    {
        return 'Продукты';
    }
}
