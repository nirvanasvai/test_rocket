@extends('admin.layouts.app')

@section('title','Отзывы')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Добавление отзыва</h2>
    <hr />
    <div>
        @include('admin.components.message')
    </div>
    <form class="form-horizontal" action="{{ route('review.store') }}" method="post" enctype="multipart/form-data" >
        @csrf

        {{-- Form include --}}
        @include('admin.review._form')
    </form>

</div>

@endsection
