@extends('admin.layouts.app')

@section('title','Создание')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Соц сети</h2>
    <hr />

    <form class="form-horizontal" action="{{ route('social.store') }}" method="post">
        @csrf

        {{-- Form include --}}
        @include('admin.contacts.social._form')

    </form>

</div>

@endsection
