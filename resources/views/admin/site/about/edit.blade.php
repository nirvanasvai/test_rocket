@extends('admin.layouts.app')

@section('title','О Компании')

@section('content')

<div class="container">

    @component('admin.components.breadcrumb')
        @slot('title') О Компании @endslot
        @slot('parent') Главная @endslot
        @slot('active') Редактировать @endslot
    @endcomponent

    @include('admin.components.message')

    <hr />

    <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('about.update', $about->id) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.site.about._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
