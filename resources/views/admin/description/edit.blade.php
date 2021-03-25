@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Партнерам</h2>
    <br>
    @include('admin.components.message')

    <hr />

    <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('description.update', $description->id) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.description._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
