<?php

namespace App\Services\Site;



use App\Models\About;
use App\Models\Brand;
use App\Models\Product;

class BrandService
{
    public function getALlPagedata()
    {
        $data['brands']=Brand::query()->get();
        $data['blog_info'] = About::query()->where('page_type', 2)->first();
        return $data;

    }
    public function getALlPagedataInner($slug)
    {
        $data['brands']=Brand::query()->where('slug',$slug)->first();
        $data['brand_info'] = About::query()->where('page_type', 2)->first();
        $data['products'] = Product::where('brand_id', $data['brands']->id)->get();

        return $data;

    }
}
?>
