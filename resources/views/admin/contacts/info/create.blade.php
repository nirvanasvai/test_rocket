@extends('admin.layouts.app')

@section('title','Создание')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Контакты</h2>

    <hr />

    <form class="form-horizontal" action="{{ route('contact.store') }}" method="post">
        @csrf

        {{-- Form include --}}
        @include('admin.contacts.info._form')

    </form>

</div>

@endsection
