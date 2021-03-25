@extends('layouts.app')

@if(isset($current_child))

    @if (isset($current_child->meta_title))
        @section('title', $category_bread->meta_title)
    @else
        @section('title', $current_child->title . ' - Timberstone')
    @endif

    @section('meta_description', $current_child->meta_description ?? '')

@else

    @if (isset($category_bread->meta_title))
        @section('title', $category_bread->meta_title)
    @else
        @section('title', $category_bread->title . ' - Timberstone')
    @endif

    @section('meta_description', $category_bread->meta_description ?? '')

@endif

@section('content')
    <div class="catalog">
        <div class="container">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="{{url('/')}}">Главная</a></li>
                    <li>
                        @if(isset($current_child))
                            <a href="{{url('/catalog/'.$category_bread->slug)}}">{{$category_bread->title}}</a></li>
                        @else
                            {{$category_bread->title}}
                        @endif
                    </li>
                    @if(isset($current_child))
                        <li>{{$current_child->title}}</li>
                    @endif
                </ul>

            </div>
            <div class="catalog_wrapper">
                <div class="mobile_catalog_category">
                    <p class="silver_text">
                        {{$category_bread->title}}
                    </p>
                    <span class="filter_toggle">
                        <img src="{{ asset('dist/images/filter.svg') }}" alt="">
                    </span>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="catalog_categories_wrapper">
                            <form action="" class="change_form">
                                @if (isset($categories_childs[0]->id))
                                    <div class="catalog_categories">
                                        <div class="title_small">
                                            <p>Категории</p>
                                        </div>
                                        <ul>
                                            @foreach ($categories_childs as $item)
                                                <li>
                                                    <input type="radio" name="radio" id="{{ $item->id }}"
                                                        value="{{ $item->id }}" disabled class="@if(request()->segment(3) == $item->slug) {{'checked'}} @endif" >
                                                    <a href="/catalog/{{$parent_url}}/{{$item->slug}}">{{ $item->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if ($filters)
                                    @foreach ($filters as $item)

                                        <div class="catalog_categories">
                                            <div class="title_small category_dropdown_toggle">
                                                <p>{{ $item->title }}</p>
                                                <span class="category_icon"></span>
                                            </div>
                                            <div class="collapse" id="collapseExample">
                                                <ul>
                                                    @foreach ($item->item as $key)

                                                        @if(isset($product_arr) && in_array($key->id,$product_arr))
                                                            <li>
                                                                <input type="checkbox" name="filters" class="product_value"
                                                                    id="filter_{{ $key->id }}" value="{{ $key->id }}">
                                                                <label for="filter_{{ $key->id }}">
                                                                    {{ $key->title_item }}</label>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                    <li class="all_categories">
                                                        <a href="#">Открыть еще</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                @if (isset($brands))
                                    <div class="catalog_categories">
                                        <div class="title_small category_dropdown_toggle">
                                            <p>Бренды</p>
                                            <span class="category_icon"></span>
                                        </div>
                                        <div class="collapse" id="collapseExample">
                                            <ul>
                                                @foreach ($brands as $brand)
                                                    <li>
                                                        <input class="product_value" type="checkbox" name="brand"
                                                            id="brand_{{ $brand->id }}" value="{{ $brand->id }}">
                                                        <label for="brand_{{ $brand->id }}">{{ $brand->name }}</label>
                                                    </li>
                                                @endforeach

                                                <li class="all_categories">
                                                    <a href="#">Открыть еще</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                @if (isset($colors))
                                    <div class="catalog_categories">
                                        <div class="title_small category_dropdown_toggle">
                                            <p>Оттенок цвета</p>
                                            <span class="category_icon"></span>
                                        </div>
                                        <div class="collapse" id="collapseExample">
                                            <ul>
                                                @foreach ($colors as $color)
                                                    <li>
                                                        <input class="product_value" type="checkbox" name="color"
                                                            value="{{ $color->id }}" id="color_{{ $color->id }}">
                                                        <label for="color_{{ $color->id }}">{{ $color->name }}</label>
                                                    </li>
                                                @endforeach
                                                <li class="all_categories">
                                                    <a href="#">Открыть еще</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <!-- <div class="catalog_categories ">
                                        <div class="title_small category_dropdown_toggle ">
                                            <p>Цена</p>
                                            <span class="category_icon "></span>
                                        </div>
                                        <div class="collapse" id="collapseExample ">
                                            <div class="price_product">
                                                    <input type="number" name="min" class="min" placeholder="От 100">
                                                    <input type="number" name="max" class="max" placeholder="До 100">
                                            </div>
                                        </div>

                                    </div> -->
                            </form>
                        </div>
                        @if(isset($advertising_banner))
                            <a href="{{url($advertising_banner->url)}}" class="advertising_banner">
                                <img src="/storage/{{ $advertising_banner->image }}" alt="">
                            </a>
                        @endif
                    </div>
                    <div class="col-xl-9 col-lg-9">
                        <div class="products_wrapper">
                            <div class="products_info">
                                <div class="title_block">
                                    @if(isset($category->sub_title))
                                        <h1>{{ $category->sub_title }}</h1>
                                    @else
                                        <h1>Что такое {{ $category->title }} ?</h1>
                                    @endif
                                </div>
                                <div class="product_info_text">
                                    <p> {!! $category->description !!}
                                    </p>
                                </div>
                            </div>
                            <div class="row product_content">

                                @foreach ($products as $product)

                                    <div class="col-xl-3 col-lg-4 col-6 col-md-4">
                                        <div class="product_card">
                                            <a href="{{ url('product/'. $product->slug) }}" class="save_product" data-id="{{ $product->id }}">
                                                <div class="product_img_title">
                                                    <div class="product_img">

                                                        @if (isset($product->childrenImg[0]->image))
                                                        <img class="main_img" src="/storage/test/{{ $product->childrenImg[0]->image }}"
                                                            alt="{{ $product->title }}">
                                                        @else
                                                        <img class="main_img" src="/dist/images/image-not-found.svg"
                                                            alt="Изображение отсутствует">

                                                        @endif
                                                        <span class="like">
                                                            <i class="far fa-heart like_icon" id="{{ $product->id }}"></i>
                                                        </span>
                                                        @if($product->sale == 1)
                                                            <span class="percent">
                                                                <img src="{{ asset('/dist/images/percent.svg') }}" alt="">
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="product_title">
                                                        <p>{{ $product->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="product_info">
                                                    <p><span class="silver_text">Артикул:&nbsp;</span> {{ $product->article }}
                                                    </p>
                                                    @foreach ($product->brands as $brand)
                                                        <p><span class="silver_text">Бренд:&nbsp;</span> {{ $brand->name }}</p>
                                                    @endforeach
                                                </div>
                                                <div class="price">
                                                    @if(isset($product->price))
                                                        <p>Цена:<span class="red_text">{{ $product->price }}<img
                                                                    src="{{ asset('/dist/images/tg.svg') }}">
                                                    @endif
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <div class="paginate">
                                {{ $products->links('paginate') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile_filter">
                    <div class="mobile_filter_header">
                        <span class="back_filter">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <p class="title">Фильтры</p>
                        <span class="silver_light close_mobile_filter">
                            Отмена
                        </span>
                    </div>
                    <div class="catalog_categories_wrapper">
                        <form action="" class="change_form">
                        @if (isset($categories_childs[0]->id))
                            <div class="catalog_categories">
                                <div class="title_small">
                                    <p>Категории</p>
                                </div>
                                <ul>
                                    @foreach ($categories_childs as $item)
                                        <li>
                                            <a href="/catalog/{{$parent_url}}/{{$item->slug}}">{{ $item->title }}</a>
                                            <input type="radio" name="radio" type="text" id="{{ $item->id }}" value="{{ $item->id }}" disabled class="@if(request()->segment(3) == $item->slug) {{'checked'}} @endif">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($filters)
                            @foreach ($filters as $item)
                                <div class="catalog_categories">
                                    <div class="title_small category_dropdown_toggle">
                                        <p>{{ $item->title }}</p>
                                        <span class="category_icon"></span>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <ul>
                                            @foreach ($item->item as $key)
                                                <li>
                                                    <label for="mob_filter_{{ $key->id }}">
                                                        {{ $key->title_item }}</label>
                                                    <input type="checkbox" name="filters" class="product_value"
                                                        id="mob_filter_{{ $key->id }}" value="{{ $key->id }}">
                                                </li>
                                            @endforeach
                                            <li class="all_categories">
                                                <a href="#">Открыть еще</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @if (isset($brands))
                            <div class="catalog_categories">
                                <div class="title_small category_dropdown_toggle">
                                    <p>Бренды</p>
                                    <span class="category_icon"></span>
                                </div>
                                <div class="collapse" id="collapseExample">
                                    <ul>
                                        @foreach ($brands as $brand)
                                            <li>
                                                <label for="mob_brand_{{ $brand->id }}">{{ $brand->name }}</label>
                                                <input class="product_value" type="checkbox" name="brand"
                                                    id="mob_brand_{{ $brand->id }}" value="{{ $brand->id }}">
                                            </li>
                                        @endforeach

                                        <li class="all_categories">
                                            <a href="#">Открыть еще</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if (isset($colors))
                            <div class="catalog_categories">
                                <div class="title_small category_dropdown_toggle">
                                    <p>Оттенок цвета</p>
                                    <span class="category_icon"></span>
                                </div>
                                <div class="collapse" id="collapseExample">
                                    <ul>
                                        @foreach ($colors as $color)
                                            <li>
                                                <label for="mob_color_{{ $color->id }}">{{ $color->name }}</label>
                                                <input class="product_value" type="checkbox" name="color"
                                                    value="{{ $color->id }}" id="mob_color_{{ $color->id }}">
                                            </li>
                                        @endforeach
                                        <li class="all_categories">
                                            <a href="#">Открыть еще</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                        {{-- <div class="catalog_categories ">
                            <div class="title_small category_dropdown_toggle ">
                                <p>Цена</p>
                                <span class="category_icon "></span>
                            </div>
                            <div class="collapse" id="collapseExample ">
                                <form action="" class="price_product">
                                    <input type="number" placeholder="От 100">
                                    <input type="number" placeholder="До 100">
                                </form>
                            </div>

                        </div> --}}
                        </form>
                    </div>
                    <button type="button" class="btn btn_red submit_filter">Применить</button>
                </div>
            </div>
        </div>
    </div>

@endsection
