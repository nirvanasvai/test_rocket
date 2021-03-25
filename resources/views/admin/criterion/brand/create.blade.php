@extends('admin.layouts.app')

@section('title','Бренды')

@section('content')

<div class="container-fluid">
    <br>
    <h2>Создание бренда</h2>
    <hr />

    <form class="form-horizontal" action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- Form include --}}
        @include('admin.criterion.brand._form')

    </form>

</div>

@endsection
