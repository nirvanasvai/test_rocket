@extends('layouts.app')

@if (isset($blog_info->meta_title))
    @section('title', $blog_info->meta_title)
@else
    @section('title', $blog_info->title_name . ' - Timberstone')
@endif

@section('meta_description', $blog_info->meta_description ?? '')

@section('content')

    <div class="partners">
        <div class="container">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li>{{$blog_info->title_name ?? 'Бренды'}}</li>
                </ul>
            </div>
            <div class="main_banner">
                <img src="/storage/{{$blog_info->image ?? ''}}" alt="">
            </div>
            <div class="title_block mb-3">
                <h1>{{$blog_info->title_name ?? 'Бренды'}}</h1>
            </div>
            {!!$blog_info->advantages ?? 'Бренды' !!}
            <div class="brands">
                @foreach ($brands as $item)
                    <div class="brand">
                        <a href="{{ route('brand.inner', $item->slug) }}"><img src="/storage/{{ $item->image }}" alt="">
                            <p>{{ $item->name }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
