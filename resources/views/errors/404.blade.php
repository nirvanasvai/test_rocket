@extends('layouts.app')
@section('title','Not Found')
@section('content')
<div class="container blogs">
    <div class="text-center mt-3 blog_content_wrapper">
        <img src="/dist/images/404.svg" alt="">
        <br><br>
        <div class="title_block">
            <h1 class="m-auto">Страница не найдена!</h1>
        </div>
    </div>
</div>
@endsection
@section('message', __('Not Found'))

