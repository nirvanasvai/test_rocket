@extends('admin.layouts.app')

@section('title','О Компании')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Редактирование страницы</h2>
    <hr />
    <div>
        @include('admin.components.message')
    </div>
    <form class="form-horizontal" action="{{ route('about.store') }}" method="post" enctype="multipart/form-data" >
        @csrf

        {{-- Form include --}}
        @include('admin.site.about._form')
    </form>

</div>

@endsection
