@extends('admin.layouts.app')

@section('title','Цвета')


@section('content')

<div class="container-fluid">
    <br>
    <h2>Редактирование цвета</h2>

    <hr />

    <form class="form-horizontal" action="{{ route('color.update',$color) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.criterion.color._form')
  </form>

</div>

@endsection
