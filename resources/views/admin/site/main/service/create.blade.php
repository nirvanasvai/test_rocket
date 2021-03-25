@extends('admin.layouts.app')

@section('title','Услуги')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Блок услуги</h2>

    <hr />
    <div>
        @include('admin.components.message')
    </div>
    <form class="form-horizontal" action="{{ route('service.store') }}" method="post" enctype="multipart/form-data" >
        @csrf

        {{-- Form include --}}
        @include('admin.site.main.service._form')
    </form>

</div>

@endsection
