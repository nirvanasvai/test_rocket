@extends('admin.layouts.app')

@section('title','Коллекции')


@section('content')

<div class="container-fluid">
    <br>
    <h2>Редактирование фильтра</h2>
    <hr />

    <form class="form-horizontal" action="{{ route('filters.update',$filter) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.filters._form')
  </form>

</div>

@endsection
