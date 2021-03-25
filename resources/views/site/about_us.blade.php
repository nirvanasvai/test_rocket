@extends('layouts.app')

@if (isset($abouts->meta_title))
    @section('title', $abouts->meta_title)
@else
    @section('title', $abouts->title_name . ' - Timberstone')
@endif

@section('meta_description', $abouts->meta_description ?? '')

@section('content')
    <div class="about_us">
        <div class="blogs">
            <div class="container">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li>О Компании</li>
                    </ul>
                </div>
                <div class="blog_content_wrapper">
                    <div class="show_mobile_category">
                        <p>{{$abouts->title_name ?? ''}} </p>
                        <i class="fas fa-sort-down"></i>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-4">
                            <div class="blogs_links mobile_blogs_links">
                                <ul>
                                    @foreach($blogs as $item)
                                        <li>
                                            <a href="{{url($item->slug)}}" class="@if(request()->path() == $item->slug) active_category @endif"><img src="/storage/{{$item->icon ?? ''}}">{{$item->title_name ?? ''}}</a>
                                        </li>
                                    @endforeach
                                    <li>
                                        <a href="{{url('contact')}}" class="@if(request()->path() == 'contact') active_category @endif"> <img src="/dist/images/icon/contacts.svg" > Контакты</a>
                                    </li>
                                </ul>
                            </div>
                            @if(isset($advertising_banner))
                                <a href="{{url($advertising_banner->url)}}" class="advertising_banner">
                                    <img src="/storage/{{ $advertising_banner->image }}" alt="">
                                </a>
                            @endif
                        </div>

                        <div class="col-xl-9 col-lg-8">
                            <div class="blog_content">
                                    <div class="blog_img">
                                    @if(isset($abouts->image))
                                        <img src="/storage/{{$abouts->image}}" alt="">
                                    @endif
                                        <div class="blog_text mt-4">
                                            <div class="title_block">
                                                <h1>О Компании</h1>
                                            </div>
                                            <p>
                                                {!!$abouts->advantages ?? ''!!}
                                            </p>
                                        </div>
                                    </div>
                            </div>
                            <div class="gallery_wrapper">
                                {{-- <div class="title">
                                    <h3>Галлерея</h3>
                                </div> --}}
                                <div class="gallery_content">
                                    <div class="gallery_slider">
                                        @foreach($galleries as $gallery)
                                        <div>
                                            <a data-fancybox="gallery" href="/images/gallery/{{$gallery->image}}">
                                                <img src="/images/gallery/{{$gallery->image}}" alt="" />
                                            </a>
                                        </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
