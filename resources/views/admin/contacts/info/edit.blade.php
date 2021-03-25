@extends('admin.layouts.app')

@section('title','Редактирование')


@section('content')

<div class="container-fluid">

    <br>
    <h2>Контакты</h2>

    <hr />

    <form class="form-horizontal" action="{{ route('contact.update',$contact) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.contacts.info._form')
  </form>

</div>

@endsection
