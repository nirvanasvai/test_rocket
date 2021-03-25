@extends('admin.layouts.app')

@section('title','Коллекции')

@section('content')

<div class="container-fluid">
    <br>
    <h2>Создание фильтра</h2>
    <hr />

    <form class="form-horizontal" action="{{ route('filters.store') }}" method="post">
        @csrf

        {{-- Form include --}}
        @include('admin.filters._form')

    </form>

</div>

@endsection
