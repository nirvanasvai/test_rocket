@extends('admin.layouts.app')

@section('title','Редактирование')
@section('content')

<div class="container-fluid">
        <br>
        <h2>Редактирование категории</h2>
        <hr />
    <form class="form-horizontal" action="{{ route('category.update', $category) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.category._form')
  </form>

</div>

@endsection
