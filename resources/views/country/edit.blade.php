@extends('admin.layouts.app')

@section('title','Страны')

@section('content')

<div class="container">

    @component('admin.components.breadcrumb')
        @slot('title') Редактирование категории @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
    @endcomponent

    <hr />

    <form class="form-horizontal" action="{{ route('category.update', $category) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.category._form')
  </form>

</div>

@endsection
