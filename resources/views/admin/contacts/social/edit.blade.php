@extends('admin.layouts.app')

@section('title','Редактирование')


@section('content')

<div class="container-fluid">

    <br>
    <h2>Соц сети</h2>

    <hr />

    <form class="form-horizontal" action="{{ route('social.update',$social) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.contacts.social._form')
  </form>

</div>

@endsection
