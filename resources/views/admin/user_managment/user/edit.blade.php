@extends('admin.layouts.app')

@section('content')

<div class="container">

    <br>
    <h2>Редактирование пользователя</h2>
    <hr />

    <form class="form-horizontal" action="{{ route('user.update', $user) }}" method="post">
        @method('PUT')
        @csrf


        {{-- Form include --}}
        @include('admin.user_managment.user.partials.form')

    </form>
</div>

@endsection
