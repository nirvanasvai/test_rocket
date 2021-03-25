@extends('admin.layouts.app')

@section('title','Баннер')

@section('content')


<div class="container-fluid">

   <br>
   <h2>Добавление баннера</h2>

    <hr />
    <div>
        @include('admin.components.message')
    </div>
    <form class="form-horizontal" action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data" >
        @csrf

        {{-- Form include --}}
        @include('admin.site.main.banner._form')
    </form>

</div>

@endsection
