@extends('admin.layouts.app')

@section('title','Категории')

@section('content')

<div class="container-fluid">
        <br>
        <h2>Создание категории</h2>
        <hr />
    <form class="form-horizontal" action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- Form include --}}
        @include('admin.category._form')

    </form>

</div>

@endsection
