@extends('admin.layouts.app')

@section('title','Добавление Товаров')

@section('content')

<div class="container-fluid">
    <br>
    <h2>Добавление товара</h2>
    <hr />
    <div>
        @include('admin.components.message')
    </div>
    <form class="form-horizontal" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" >
        @csrf

        {{-- Form include --}}
        @include('admin.product._form')
    </form>

</div>

@endsection
