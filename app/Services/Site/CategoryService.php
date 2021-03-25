<?php

namespace App\Services\Site;

use App\Http\Requests\CategoryRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Filter;
use App\Models\FiltersRelations;
use App\Models\Product;
use App\Models\Banner;
use App\Services\Filters\ProductFilterService;

class CategoryService
{
    public function getALlPagedata(ProductFilterService $filters, $category, $sub_category)
    {
//        dd($category,$sub_category);
        $data['category_bread'] = Category::query()->where('slug',$category,$sub_category)->first();
        $data['current_child'] = Category::query()->where('slug',$sub_category)->first();
        if($sub_category == NULL){
            $catalog_id = Category::where('slug', $category)->first();
        }else{
            $catalog_id = Category::where('slug', $sub_category)->first();
        }
        if(!$catalog_id){
            abort(404);
        }
        if($catalog_id->parent_id != NULL){
            $data['categories_childs'] = Category::query()
                ->where('parent_id', $catalog_id->parent_id)
                ->with('childs')
                ->where('status', 1)
                ->get();
        }else{
            $data['categories_childs'] = Category::query()
                ->where('parent_id', $catalog_id->id)
                ->with('childs')
                ->where('status', 1)
                ->get();
        }

        if($data['categories_childs']->count() > 0){
            foreach ($data['categories_childs'] as $item) {
                $childs[] = $item->id;
            }

        }else{
            $childs = NULL;
        }

        if($childs != NULL){
            if ($sub_category == NULL){
               $data['products'] = Product::query()
                ->whereIn('category_id', $childs)
                ->where('status', 1)
                ->with('brands')
                ->filter($filters)
                ->paginate(48)->withQueryString();


            }else{
                $data['products'] = Product::query()
                ->where('category_id', $catalog_id->id)
                ->where('status', 1)
                ->with('brands')
                ->filter($filters)
                ->paginate(48)->withQueryString();

            }
            if(count($data['products']) > 0){
                foreach ($data['products'] as $item) {
                    $colors[] = $item->color_id;
                    $brands[] = $item->brand_id;
                }
                if ($colors) {
                    $data['colors'] = Color::whereIn('id', $colors)->get();
                }
                if ($brands) {
                    $data['brands'] = Brand::whereIn('id', $brands)->get();
                }
            }
        }else{
            $data['products'] = Product::query()
                ->where('category_id', $catalog_id->id)
                ->where('status', 1)
                ->with('brands')
                ->filter($filters)
                ->paginate(48);
            if(count($data['products']) > 0){
                foreach ($data['products'] as $item) {
                    $colors[] = $item->color_id;
                    $brands[] = $item->brand_id;
                }
                if ($colors) {
                    $data['colors'] = Color::whereIn('id', $colors)->get();
                }
                if ($brands) {
                    $data['brands'] = Brand::whereIn('id', $brands)->get();
                }
            }
        }
        if(isset($data['products'])){
            foreach($data['products'] as $item){
                $relations = FiltersRelations::where('product_id', $item->id)->first();
                if(isset($relations)){
                    $data['product_arr'][] = $relations->filter_id;
                //dd($data['product_arr']);
                }
            }
            if(isset($data['product_arr'])){
                $data['product_arr'] = array_unique($data['product_arr']);
            }

            //dd($data['product_arr']);
        }
        if($catalog_id->filters){
            $data['filters'] = Filter::whereIn('id', json_decode($catalog_id->filters))->get();
        }else{
            $data['filters'] = [];
        }
        $data['advertising_banner'] = Banner::first();
        $data['category'] = $catalog_id;
        $data['parent_url'] = $category;
        $data['categories_mobile'] = Category::query()->whereNull('parent_id')->get();
        return $data;
    }
}
?>
