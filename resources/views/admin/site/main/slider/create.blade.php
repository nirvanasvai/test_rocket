@extends('admin.layouts.app')

@section('title','Слайдер')

@section('content')


<div class="container-fluid">

   <br>
   <h2>Добавление слайда</h2>

    <hr />
    <div>
        @include('admin.components.message')
    </div>
    <form class="form-horizontal" action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data" >
        @csrf

        {{-- Form include --}}
        @include('admin.site.main.slider._form')
    </form>

</div>

@endsection
