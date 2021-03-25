<?php
namespace App\Services\Filters;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductFilterService extends QueryFilterService
{
    public function country($value)
    {
        return $this->builder->where('country_id', '=', $value);
    }
    public function collection($value)
    {
        return $this->builder->where('collection_id', '=', $value);
    }
    public function brand($value)
    {
        return $this->builder->whereHas('brands', function($query) use ($value)
        {
            $query->where('name', $value);
        });
    }
    public function category($value)
    {
        return $this->builder->where('category_id','=',$value);
    }
    public function color($value)
    {
        return $this->builder->where('color_id', '=', $value);
    }


}
