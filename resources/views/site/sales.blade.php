@extends('layouts.app')
@section('meta_title', $products->meta_title ?? '')
@section('meta_keyword', $products->meta_keyword ?? '')
@section('meta_description', $products->meta_description ?? '')

@section('title', 'Акции - Timberstone')

@section('content')
    <div class="catalog">
        <div class="container">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="{{url('/')}}">Главная</a></li>
                    <li>Акции</li>
                </ul>
            </div>
            <div class="catalog_wrapper">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="catalog_categories_wrapper">
                            <form action="" class="change_form">

                                @if ($filters)
                                    @foreach ($filters as $item)
                                         <?php 
                                            $check = false;
                                        ?>
                                        @foreach ($item->item as $key)
                                            @if(isset($arr_items) && in_array($key->id,$arr_items))
                                                <?php 
                                                    $check = true;
                                                ?>
                                            @endif
                                        @endforeach
                                        @if($check)
                                            <div class="catalog_categories">
                                                <div class="title_small category_dropdown_toggle">
                                                    <p>{{ $item->title }}</p>
                                                    <span class="category_icon"></span>
                                                </div>
                                                <div class="collapse" id="collapseExample">
                                                    <ul>
                                                        @foreach ($item->item as $key)
                                                            @if(isset($arr_items) && in_array($key->id,$arr_items))
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
                                        @endif
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
                        <a href="#" class="advertising_banner">
                            <img src="{{ asset('dist/images/advertising.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-xl-9 col-lg-9">
                        <div class="products_wrapper">
                            <div class="row product_content">
                                @foreach ($products as $product)
                                    <div class="col-xl-3 col-lg-4 col-6 col-md-4">
                                        <div class="product_card">
                                            <a href="{{ url('product/'. $product->slug) }}" class="save_product" data-id="{{ $product->id }}">
                                                <div class="product_img_title">
                                                    <div class="product_img">

                                                        <img class="main_img" src="/storage/test/{{ isset($product->childrenImg[0]->image) ? $product->childrenImg[0]->image : null }}"
                                                            alt="{{ isset($product->childrenImg[0]->image) ? $product->childrenImg[0]->image : null }}">

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
                                                    <p><span class="silver_text">Артикул:</span> {{ $product->article }}
                                                    </p>
                                                    @foreach ($product->brands as $brand)
                                                        <p><span class="silver_text">Бренд:</span> {{ $brand->name }}</p>
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
                                                    <input type="checkbox" name="filters" class="product_value"
                                                        id="filter_{{ $key->id }}" value="{{ $key->id }}">
                                                    <label for="filter_{{ $key->id }}">
                                                        {{ $key->title_item }}</label>
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
                    </div>
                    <button type="button" class="btn btn_red">Применить</button>
                </div>
            </div>
        </div>
    </div>

@endsection
