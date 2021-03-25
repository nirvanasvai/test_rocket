@extends('admin.layouts.app')

@section('title','Страны')

@section('content')

<div class="container">

    @component('admin.components.breadcrumb')
        @slot('title') Создание Брендов @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
    @endcomponent

    <hr />

    <form class="form-horizontal" action="{{ route('brand.store') }}" method="post">
        @csrf

        {{-- Form include --}}
        @include('admin.criterion.brand._form')

    </form>

</div>

@endsection
