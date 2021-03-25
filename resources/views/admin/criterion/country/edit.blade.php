@extends('admin.layouts.app')

@section('title','Страны')


@section('content')

<div class="container-fluid">
    <br>
    <h2>Редактирование страны</h2>

    <hr />

    <form class="form-horizontal" action="{{ route('country.update',$country) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.criterion.country._form')
  </form>

</div>

@endsection
