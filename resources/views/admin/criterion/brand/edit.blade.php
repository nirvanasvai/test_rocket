@extends('admin.layouts.app')

@section('title','Бренды')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Редактирование бренда</h2>
    <hr />

    <form class="form-horizontal" action="{{ route('brand.update', $brand) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.criterion.brand._form')
  </form>

</div>

@endsection
