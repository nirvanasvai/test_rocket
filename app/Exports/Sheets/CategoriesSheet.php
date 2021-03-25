<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoriesSheet implements FromQuery, WithTitle, ShouldAutoSize, WithHeadings
{

    public function headings(): array
    {
        return [
           'Категория', 'Подкатегория', 'ID Категории'
        ];
    }

    public function query()
    {

        $data = Category::query()->whereNull('categories.parent_id')->leftJoin('categories as child', 'child.parent_id', 'categories.id')->select('categories.title as parent_title', 'child.title as child_title', DB::raw('(CASE WHEN child.id IS NULL THEN categories.id ELSE child.id END) AS id_cat'));

        return $data;
    }

    public function title(): string
    {
        return 'Категории';
    }
}
