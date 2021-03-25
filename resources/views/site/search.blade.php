@extends('layouts.app')

@section('title', 'Результаты поиска - Timberstone')

@section('content')
    <div class="products_wrapper search_products">
        <div class="container">
            <div class="title_page_block mb-3 mt-4">
                <p>Результаты поиска!</p>
            </div>
            <div class="row">
                @forelse($products as $item)
                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-6">
                        <div class="product_card">
                            <a href="/product/{{$item->product_link}}">
                                <div class="product_img_title">
                                    <div class="product_img">
                                        <img src="/storage/test/{{ isset($item->childrenImg[0]->image) ? $item->childrenImg[0]->image : null }}" alt="">
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
                                @if($item->price)
                                    <div class="price">
                                        <p>Цена:<span class="red_text">{{ number_format($item->price, 0, '', ' ') }} <img src="/dist/images/tg.svg" alt=""></span></p>
                                    </div>
                                @endif
                            </a>
                        </div>
                    </div>
                @empty
                <div class="title_page_block ml-3 mr-3 error_search w-100">
                    <img src="{{ asset('/dist/images/error-search.svg') }}" alt="" class="w-100">
                </div>
            @endforelse
            </div>
        </div>
    </div>
@endsection
