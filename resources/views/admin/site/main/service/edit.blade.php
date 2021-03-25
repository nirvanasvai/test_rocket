@extends('admin.layouts.app')

@section('title','Услуги')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Блок услуги</h2>

    <hr />
    <form class="form-horizontal" action="{{ route('service.update', $service->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.site.main.service._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
