@extends('admin.layouts.app')

@section('title','Галлерея')

@section('content')

    <div class="container-fluid">

        <br>
        <h2>Загрузить изображение</h2>
        
        <hr />
        <div>
            @include('admin.components.message')
        </div>
        <form class="form-horizontal" action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data" >
            @csrf

            {{-- Form include --}}
            @include('admin.site.about.gallery._form')
        </form>

    </div>

@endsection
