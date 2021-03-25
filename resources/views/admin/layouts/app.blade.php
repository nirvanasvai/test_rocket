<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/svg" sizes="16x16" href="{{asset('dist/images/tg.svg')}}">
    <title>@yield('title')</title>
    <link href="{{asset('back/assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('back/assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('back/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link href="{{asset('back/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('input/input.css')}}" rel="stylesheet">







</head>
<body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

    @include('admin.layouts.header')
    <div class="page-wrapper">
        @yield('content')

    </div>
</div>

<script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('laravel-ckeditor/ckeditor.js')}}"></script>

<script src="{{asset('laravel-ckeditor/config.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('back/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('back/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<!-- apps -->
<!-- apps -->
<script src="{{asset('back/dist/js/app-style-switcher.js')}}"></script>
<script src="{{asset('back/dist/js/feather.min.js')}}"></script>
<script src="{{asset('back/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('back/dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('back/dist/js/custom.min.js')}}"></script>
<!--This page JavaScript -->
<script src="{{asset('back/assets/extra-libs/c3/d3.min.js')}}"></script>
<script src="{{asset('back/assets/extra-libs/c3/c3.min.js')}}"></script>
<script src="{{asset('back/assets/libs/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('back/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{asset('back/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('back/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('back/dist/js/pages/dashboards/dashboard1.min.js')}}"></script>

<script src="{{asset('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
<script src="{{asset('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('input/input.js')}}"></script>
<script src="{{asset('input/input_filter.js')}}"></script>
</body>

</html>
