@extends('admin.layouts.app')

@section('title','Цвета')


@section('content')

<div class="container-fluid">

<br>
        <h2>Редатирование заявки</h2>
        <br>

    <hr />

    <form class="form-horizontal" action="{{ route('call.update',$call) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.call._form')
  </form>

</div>

@endsection
