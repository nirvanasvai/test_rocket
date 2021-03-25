@extends('layouts.app')

@if (isset($brands->meta_title))
    @section('title', $brands->meta_title)
@else
    @section('title', $brands->name . ' - Timberstone')
@endif

@section('meta_description', $brands->meta_description ?? '')

@section('content')

    <div class="brands_inner">
        <div class="container">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="{{url('/')}}">{{'Главная'}}</a></li>
                    <li><a href="{{url('/brands')}}">Бренды</a></li>
                    <li>{{$brands->name}}</li>
                </ul>
            </div>
            <div class="logo_brands">
                <img src="/storage/{{$brands->image}}" alt="">
            </div>
            <div class="brands_description">
                <div class="brands_name">
                    <h3>{{$brands->name}}</h3>
                </div>
                <div class="brands_text">
                    <p>
                        {!!$brands->description!!}</p>
                </div>
            </div>

            <div class="brands_products">
                @if ($products->count() > 0)
                    <div class="title">
                        <h3>Товары компании</h3>
                    </div>
                @endif

                <div class="products_wrapper">
                    <div class="row mt-4">
                        @foreach($products as $item)
                            <div class="col-xxl-3 col-xl-3 col-lg-4 col-6">
                            <div class="product_card">
                                <a href="/product/{{$item->slug}}">
                                    <div class="product_img_title">
                                        <div class="product_img">
                                            <img class="main_img" src="/storage/test/{{$item->childrenImg()->first()->image ?? ''}}" alt="">
                                            <span class="like">
                                                <i class="far fa-heart like_icon"></i>
                                            </span>
                                            @if($item->sale == 1)
                                                <span class="percent">
                                                    <img src="{{ asset('/dist/images/percent.svg') }}" alt="">
                                                </span>
                                            @endif
                                        </div>
                                        <div class="product_title">
                                            <p>{{$item->name}}</p>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <p><span class="silver_text">Артикул:</span>{{$item->article}}</p>
                                        @foreach($item->brands as $brand)
                                            <p><span class="silver_text">Бренд:</span> {{$brand->name}}</p>
                                        @endforeach
                                    </div>
                                    <div class="price">
                                        @if(isset($price))
                                        <p>Цена:<span class="red_text">{{ number_format($item->price, 0, '', ' ') }} <img src="/dist/images/tg.svg" alt=""></span></p>
                                            @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


@endsection
