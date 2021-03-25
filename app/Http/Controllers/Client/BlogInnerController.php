<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Site\BlogInnerService;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\About;
use App\Models\Description;
use App\Models\Review;

class BlogInnerController extends Controller
{
    private $BlogService;

    public function __construct(){
        $this->BlogService=new BlogInnerService();
    }

    public function show(){
        $data=$this->BlogService->getALlPageData();
        return view('site.blog.saidebar',$data);
    }

    public function search(Request $request)
    {

        $keyword = $request->input('text');
        $products = Product::where('products.status', 1)
        ->join('categories', 'products.category_id', 'categories.id')
        ->where('categories.status', 1)
        ->join('colors', 'products.color_id', 'colors.id')
        ->join('brands', 'products.brand_id', 'brands.id')
        ->join('countries', 'products.country_id', 'countries.id')
        ->where('products.name', 'LIKE', '%'.$keyword.'%')
        ->orWhere('products.description','LIKE', '%'.$keyword.'%')
        ->orWhere('products.article','LIKE', '%'.$keyword.'%')
        ->orWhere('specifications', 'LIKE', '%'.$keyword.'%')
        ->orWhere('products.benefits','LIKE','%'.$keyword.'%')
        ->orWhere('categories.title', 'LIKE', '%'.$keyword.'%')
        ->orWhere('brands.name', 'LIKE', '%'.$keyword.'%')
        ->orWhere('countries.name', 'LIKE', '%'.$keyword.'%')
        ->orWhere('colors.name', 'LIKE', '%'.$keyword.'%')
        ->select('products.id', 'products.slug as product_link','categories.slug as category_url','products.name','products.article', 'products.price', 'products.brand_id', 'products.sale')
        //dd($products);
        ->paginate(50)->withQueryString();
        return view('site.search', compact('products'));
    }
    public function sales(Request $request)
    {
        $blog_info = About::where('page_type', 1)->first();

        $blogs = About::orderBy('page_type','ASC')->where('page_type', '!=', 6)->where('page_type', '!=', 5)->get();
        $advertising_banner = Banner::first();
        if(!$blog_info){
            abort(404);
        }

        return view('site.blog.sales', compact('blog_info', 'blogs','advertising_banner'));
    }
    public function partners(Request $request)
    {
        $blogs = Description::query()->get();
        $menu = About::orderBy('page_type','ASC')->where('page_type', '!=', 6)->where('page_type', '!=', 5)->get();
        $blog_info = About::where('page_type', 4)->first();
        $advertising_banner = Banner::first();
        if(!$blog_info){
            abort(404);
        }

        return view('site.blog.partners', compact('blog_info', 'blogs','menu','advertising_banner'));
    }


    public function ajaxSearch(Request $request)
    {
        if($request->ajax())
        {
            $keyword = $request->input('text');
            $return = Product::where('products.status', 1)
            ->join('categories', 'products.category_id', 'categories.id')
            ->where('categories.status', 1)
            ->join('colors', 'products.color_id', 'colors.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->join('countries', 'products.country_id', 'countries.id')
            ->where('products.name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('products.description','LIKE', '%'.$keyword.'%')
            ->orWhere('products.article','LIKE', '%'.$keyword.'%')
            ->orWhere('specifications', 'LIKE', '%'.$keyword.'%')
            ->orWhere('products.benefits','LIKE','%'.$keyword.'%')
            ->orWhere('categories.title', 'LIKE', '%'.$keyword.'%')
            ->orWhere('brands.name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('countries.name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('colors.name', 'LIKE', '%'.$keyword.'%')
            ->select('products.id as product_id', 'products.slug as product_link','categories.slug as category_url','products.name as product_name')->limit(5)->get();
            $return = json_encode($return);

            return $return;

        }else{
            return 'Not Ajax';
        }
    }
    public function apiFilter(Request $request){
        if($request->ajax())
        {
            $requestData = $request->all();

            if($requestData['category_slug'] == 'sales'){
                $builder = Product::where('status', 1)->where('sale', 1);
            }else{
                $category = Category::where('slug', $requestData['category_slug'])->first();

                $check_product = Product::where('category_id', $category->id)->where('status', 1)->first();

                if($check_product){
                    $builder = Product::where('category_id', $category->id)->where('status', 1);
                }else{
                    $sub_category = Category::where('parent_id', $category->id)->select('id')->get()->toArray();
                    $builder = Product::whereIn('category_id', $sub_category)->where('status', 1);
                }
            }
            if ($request->has('color')) {
                $builder->whereIn('color_id', $requestData['color']);
            }
            if ($request->has('brand')) {
                $builder->whereIn('brand_id', $requestData['brand']);
            }
            if ($request->has('collection')) {
               // $collection = FiltersRelations::whereIn('filter_id',$requestData['collection'])->get();

                $builder->join('filters_relations', 'filters_relations.product_id','products.id')
                        ->whereIn('filters_relations.filter_id', $requestData['collection'])->get();
            }


            /*if ($request->has('min_price')) {
                $builder->where('price', '>=', $requestData['min_price']);
            }

            if ($request->has('max_price')) {
                $builder->where('price', '<=', $requestData['max_price']);
            }*/

            $builder->with('colors', function ($query){
                $query->select('id','name as color_name')->get();
            });
            $builder->with('brands', function ($query){
                $query->select('id','name as brand_name')->get();
            });
            $products = $builder
                        ->with('childrenImg', function ($query)
                        {
                            $query->select('product_id','image as product_img')->get();
                        })->select('products.id','products.name','products.slug as product_url','article','price', 'brand_id','color_id', 'sale')->get();
            $products = json_encode($products);

            return $products;
        }else{
            return 'Not Ajax';
        }
    }


    public function apiFavorites(Request $request){
        if($request->ajax())
        {
            $requestData = $request->all();
            $builder = Product::whereIn('id', $requestData['id'])->where('status', 1);
            $builder->with('brands', function ($query)
                    {
                        $query->select('id','name as brand_name');
                    });
            $products = $builder
                        ->with('childrenImg', function ($query)
                        {
                            $query->select('product_id','image as product_img')->get();
                        })->select('id','name','products.slug as product_url','article','price', 'brand_id','color_id', 'sale')->get();
                        $products = json_encode($products);
            return $products;
        }else{
            return 'Not Ajax';
        }
    }

    public function ratingCount(Request $request)
    {
        //dd($request->input('id'));
        $review_count = Review::query()->where('product_id', $request->get('id'))->where('status', 1)->count();
        $review_summ = Review::query()->where('product_id', $request->get('id'))->where('status', 1)->sum('rating');
        if($review_count > 0){
            $review = $review_summ/$review_count;
        }else{
            $review = 0;
        }
        return round($review);
    }
}
