@extends('admin.layouts.app')

@section('title','Информационные страницы')

@section('content')

<div class="container-fluid">
    <br>
    <h2>Добавить страницу</h2>

    <hr />
    <div>
        @include('admin.components.message')
    </div>
    <form class="form-horizontal" action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data" >
        @csrf

        {{-- Form include --}}
        @include('admin.blog._form')
    </form>

</div>

@endsection
