@extends('layouts.app')

@if (isset($blog->meta_title))
    @section('title', $blog->meta_title)
@else
    @section('title', $blog->title . ' - Timberstone')
@endif

@section('meta_description', $blog->meta_description ?? '')

@section('content')
    <div class="blogs">
        <div class="container">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li>{{$blog->title}}</li>
                </ul>
            </div>
            <div class="blog_content_wrapper">
                <div class="show_mobile_category">
                    <p>{{$blogsMobile->title ?? ''}} </p>
                    <i class="fas fa-sort-down"></i>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="blogs_links mobile_blogs_links">
                            <ul>
                                @foreach($blogs as $item)
                                    <li>
                                        <a href="section_{{$item->id}}" ><img src="/storage/{{$blog->icon ?? ''}}" alt=""> {{$blog->title ?? ''}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @include('site.blog.blogs')
                </div>
            </div>
        </div>
    </div>





@endsection
