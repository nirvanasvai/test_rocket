<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Social;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Date::setlocale(config('app.locale'));

        $this->topMenu();
        $this->topBlog();
        $this->social();
        $this->contact();
        $this->about();
        $this->sales();
        $this->brands();
        $this->partners();
        $this->services();
        $this->brand_name();
    }

    public function topMenu()
    {
        View::composer('layouts.app', function ($view) {
            $view->with('categories', Category::query()->whereNull('parent_id')->where('status', 1)->get());
        });
    }
    public function topBlog()
    {
        View::composer('layouts.app', function ($view ) {
            $view->with('blogs', Blog::query()->first());
        });
    }

    public function social()
    {
        View::composer('layouts.app', function ($view ) {
            $view->with('socials', Social::query()->first());
        });
    }
    public function contact()
    {
        View::composer('layouts.app', function ($view) {
            $view->with('contact', Contact::query()->first());
        });
    }

    public function about()
    {
        View::composer('layouts.app', function ($view ) {
            $view->with('about', About::query()->where('page_type', 0)->first());
        });
    }
    public function sales()
    {
        View::composer('layouts.app', function ($view ) {
            $view->with('sales', About::query()->where('page_type', 1)->first());
        });
    }
    public function brands()
    {
        View::composer('layouts.app', function ($view ) {
            $view->with('brands', About::query()->where('page_type', 2)->first());
        });
    }
    public function services()
    {
        View::composer('layouts.app', function ($view ) {
            $view->with('services', About::query()->where('page_type', 3)->first());
        });
    }
    public function partners()
    {
        View::composer('layouts.app', function ($view ) {
            $view->with('partners', About::query()->where('page_type', 4)->first());
        });
    }
    public function brand_name()
    {
        View::composer('layouts.app',  function ($view ) {
            $view->with('brand_name', Brand::query()->first());
        });
    }
}
