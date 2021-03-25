@extends('admin.layouts.app')

@section('title','О нас')

@section('content')

<div class="container">

    <br>
        <h2>Партнерам</h2>
    <br>

    <hr />
    <div>
        @include('admin.components.message')
    </div>
    <form class="form-horizontal" action="{{ route('description.store') }}" method="post" enctype="multipart/form-data" >
        @csrf

        {{-- Form include --}}
        @include('admin.description._form')
    </form>

</div>

@endsection
