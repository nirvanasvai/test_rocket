@extends('admin.layouts.app')

@section('title','Редактирование')

@section('content')

<div class="container-fluid">

   <br>
   <h2>Редактирование баннера</h2>

    <hr />
    <form class="form-horizontal" action="{{ route('banner.update', $slider->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.site.main.banner._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
