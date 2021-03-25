@extends('layouts.app')

@if (isset($blog_info->meta_title))
    @section('title', $blog_info->meta_title)
@else
    @section('title', $blog_info->title_name . ' - Timberstone')
@endif

@section('meta_description', $blog_info->meta_description ?? '')

@section('content')
    <div class="blogs">
        <div class="container">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li>Услуги</li>
                </ul>
            </div>
            <div class="blog_content_wrapper">
                <div class="show_mobile_category">
                    <p>{{$blog_info->title_name ?? ''}} </p>
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
                                <img src="/storage/{{$blog_info->image ?? ''}}" alt="">
                            </div>
                            <div class="title_block">
                                 <h1>{{$blog_info->title_name ?? ''}}</h1>
                            </div>
                            <div class="blog_text">
                                <p>
                                    @if($blog_info->page_type == 3) {!!$blog_info->advantages ?? ''!!} @else {!!$blog_info->description ?? ''!!} @endif
                                </p>
                            </div>
                        </div>
                        <div class="blog_content">
                            @foreach($service as $item)
                            <div class="title_block">
                                <h2>{{$item->name ?? ''}}</h2>
                            </div>
                            <div class="blog_img">
                                <img src="/storage/{{$item->main_image ?? ''}}" alt="">
                            </div>
                            <div class="blog_text">
                                <p>{!!$item->description_title ?? ''!!}
                                </p>
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
