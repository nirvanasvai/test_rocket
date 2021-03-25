@extends('layouts.app')

@if (isset($blog_info->meta_title))
    @section('title', $blog_info->meta_title)
@else
    @section('title','Главная - Timberstone')
@endif

@section('meta_description', $blog_info->meta_description ?? '')

@section('content')

    <div class="main_wrapper">
        <div class="container">
            <div class="category row m-0">
                @foreach($mains as $main)
                    <div class="col-xl-3 col-6 col-lg-3 p-0">
                        <a href="{{url('/catalog'.'/'. $main->slug)}}" class="card_category">
                            <img src="/images/category/{{$main->image}}" alt="">
                            <div class="card_category_text">
                                <span></span>
                                <h5>{{$main->title}}</h5>
                                <p>{{$main->description_short}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="main_slider">
                @foreach($sliders as $slider)
                    <div>
                        @if(isset($slider->url))
                        <a href="{{$slider->url}}">
                        @endif
                            <div class="slick_slide_item" style="background-image: url(/storage/{{$slider->image}})">
                                <div class="slider_text col-xl-6 col-lg-6 col-md-8">
                                    <h3>{{$slider->title}}</h3>
                                    <p>{{$slider->description}}</p>
                                </div>
                            </div>
                        @if(isset($slider->url))
                        </a>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="brands m_mobile">
                <div class="title">
                    <h3>{{$brands_page->title_name}}</h3>
                    <a href="{{url($brands_page->slug)}}">Смотреть все</a>
                </div>
                <div class="services_text">
                    <p>{!! $brands_page->description ?? ''!!}</p>
                </div>
                <div class="brands_slider">
                    @foreach($brands as $brand)
                    <a href="{{route('brand.inner',$brand->slug)}}" class="brand_item">
                        <img src="/storage/{{$brand->image}}" alt="{{$brand->name}}">
                        <p>{{$brand->name}}</p>
                    </a>
                    @endforeach
                </div>
                <div class="mobile_block">
                    <a href="{{url($brands_page->slug)}}">Смотреть все</a>
                </div>
            </div>
            <div class="main_about_company m_mobile">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <img src="/storage/{{$about_page->block_image ?? ''}}" alt="О компании">
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="main_about_company_text">
                            <div class="title">
                                <h3>О компании</h3>
                            </div>
                            <p>{!!$about_page->description ?? ''!!}</p>
                            <a href="{{url($about_page->slug)}}">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services m_mobile">
                <div class="title">
                    <h3>{{$service_page->title_name}}</h3>
                    <a href="{{url($service_page->slug)}}">Смотреть все</a>
                </div>
                <div class="services_text">
                    <p>{!! $service_page->description ?? ''!!}</p>
                </div>
                <div class="card_info_wrapper slider_services">
                        @foreach($services as $service)
                            <a href="{{url($service_page->slug)}}">
                                <div class="card_info">
                                    <img src="/storage/{{$service->image}}" alt="{{$service->name}}">
                                    <p class="bold_text">{{$service->name}}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                </div>
                <div class="mobile_block">
                    <a href="{{url($about_page->slug)}}">Смотреть все</a>
                </div>
            </div>
            <div class="services more_services m_mobile">
                <div class="title">
                    <h3>{{$partners_page->title_name}}</h3>
                </div>
                <div class="services_text">
                    <p>{!!$partners_page->description ?? ''!!}</p>
                </div>
                <div class="card_info_wrapper">
                    <div class="row">
                        @foreach($descriptions as $item)
                        <div class="col-xl-4 col-lg-4">
                            <a href="{{url($partners_page->slug)}}">
                                <div class="card_info">
                                    <img src="/storage/{{$item->image}}" alt="{{$item->title}}">
                                    <div class="card_info_text">
                                        <p class="bold_text">{{$item->title}}
                                        </p>
                                        <p>{{$item->description}} </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="mobile_block">
                    <a href="{{url('/'.$descriptions[0]->slug)}}">Смотреть все</a>
                </div>
            </div>
        </div>
    </div>
@endsection
