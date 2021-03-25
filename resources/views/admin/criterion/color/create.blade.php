@extends('admin.layouts.app')

@section('title','Цвета')

@section('content')

<div class="container-fluid">
    <br>
    <h2>Создание цвета</h2>
    <hr />

    <form class="form-horizontal" action="{{ route('color.store') }}" method="post">
        @csrf

        {{-- Form include --}}
        @include('admin.criterion.color._form')

    </form>

</div>

@endsection
