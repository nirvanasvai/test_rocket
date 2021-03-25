@extends('admin.layouts.app')

@section('title','Редактиование заявки')


@section('content')

<div class="container">

    @component('admin.components.breadcrumb')
        @slot('title') Редактирование заявки @endslot
        @slot('parent') Главная @endslot
        @slot('active') Заявка @endslot
    @endcomponent

    <hr />
    <form class="form-horizontal" action="{{ route('callUrl.update',$call) }}" method="post">
        @method('PUT')
        @csrf
        {{-- Form include --}}
        @include('admin.call.callUrl._form')
  </form>

</div>

@endsection
