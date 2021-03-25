<?php

namespace App\Services\Site;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Feature;

class ProductInnerService
{
    public function getALlPagedata($slug)
    {

        $data['products'] = Product::query()
            ->where('products.slug',$slug)
            ->where('status', 1)
            ->first();
        if(!$data['products']){
            abort(404);
        }
          $data['feature'] = Feature::query()->where('product_id', $data['products']->id)->get();
          $data['catalog'] = Category::query()->first();

          $review_count = Review::query()->where('product_id', $data['products']->id)->where('status', 1)->count();
          $review_summ = Review::query()->where('product_id', $data['products']->id)->where('status', 1)->sum('rating');
          if($review_count > 0){
            $data['review'] = $review_summ/$review_count;
          }else{
            $data['review'] = 0;
          }

        return $data;
    }
}
?>
