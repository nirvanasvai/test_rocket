@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Создание пользователя</h2>

    <hr />

    <form class="form-horizontal" action="{{route('user.store')}}" method="post">
        @csrf

        {{-- Form include --}}
        @include('admin.user_managment.user.partials.form')

    </form>
</div>

@endsection
