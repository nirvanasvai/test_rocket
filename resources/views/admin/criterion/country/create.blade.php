@extends('admin.layouts.app')

@section('title','Страны')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Создание страны</h2>
    <hr />

    <form class="form-horizontal" action="{{ route('country.store') }}" method="post">
        @csrf

        {{-- Form include --}}
        @include('admin.criterion.country._form')

    </form>

</div>

@endsection
