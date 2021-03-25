<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    public $table = 'products';

    protected $fillable =
        [
        'name','article','image','description','specifications','color_id',
        'benefits','price','brand_id','sale','country_id', 'category_id','slug', 'sale', 'status'
    ];

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug($this->name);
    }

    public function rating($id)
    {
        $rates = Review::where('product_id',$id)
            ->selectRaw('SUM(rating)/COUNT(product_id) AS avg_rating'
            )->first()->avg_rating;
        $rateArray =[];
        foreach ($rates as $rate)
        {
            $rateArray[]= $rate['rating'];
        }

        $sum = array_sum($rateArray);
        $result = $sum/5;

        return (['rating'=>$result]);
    }

    public function addProduct($request)
    {
        $ar = [
            'name' =>$request->get('name'),
            'article' => $request->get('article'),
            'description' => $request->get('description'),
            'specifications' => $request->get('specifications'),
            'benefits' => $request->get('benefits'),
            'price' => $request->get('price'),
            'sale' => $request->get('sale'),
            'brand_id'=>$request->get('brand_id'),
            'country_id'=>$request->get('country_id'),
            'category_id'=>$request->get('category_id'),
            'color_id'=>$request->get('color_id'),
            'slug'=>$request->get('slug'),
            'meta_title'=>$request->get('meta_title'),
            'meta_description'=>$request->get('meta_description'),
        ];

        return Product::create($ar);
    }

//    public function addColors($request,$product_id)
//    {
//        $colors = $request->get('color_id');
//        foreach ($colors as $color)
//        {
//            $ar[] = [
//                'product_id' => $product_id,
//                'color_id' => $color,
//                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
//            ];
//        }
//        $product = $this->query()->find($product_id);
//
//        $product->colors()->attach($ar);
//    }

    public function updateProduct($request, $id)
    {
        $product = Product::query()->find($id);
        $product->name = $request->get('name');
        $product->article = $request->get('article');
        $product->description = $request->get('description');
        $product->specifications = $request->get('specifications');
        $product->benefits = $request->get('benefits');
        $product->price = $request->get('price');
        $product->sale = $request->get('sale');
        $product->category_id = $request->get('category_id');
        $product->slug = $request->get('slug');
        $product->sale = $request->get('sale');
        $product->meta_title = $request->get('meta_title');
        $product->meta_description = $request->get('meta_description');

        $product->update();
        return $product;
    }

    public function scopeLastProducts($query, $count)
    {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }

    //Отношении

    public function brands()
    {
        return $this->hasMany(Brand::class,'id', 'brand_id');
    }
    public function getCatalog(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function countries()
    {
        return $this->hasOne(Country::class,'id', 'country_id');
    }
    public function colors()
    {
        return $this->hasMany(Color::class, 'id', 'color_id');
    }
    public function review()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function feature()
    {
        return $this->hasMany(Feature::class, 'product_id', 'id');
    }

    public function brand()
    {
        return $this->hasMany(Brand::class, 'product_id', 'id');
    }
    public function filter()
    {
        return $this->hasMany(FilterItem::class, 'id', 'filter_id');
    }


    public function childrenImg(){
        return $this->hasMany(Image::class,'product_id', 'id');
    }

    public function scopeFilter($builder, $filters)
    {
        return $filters->apply($builder);
    }

    public function scopeFilters()
    {
        return $this->hasMany(FiltersRelations::class, 'product_id', 'id');
    }

}
