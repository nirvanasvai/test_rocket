@extends('admin.layouts.app')

@section('title','Редактирование')

@section('content')

<div class="container-fluid">

   <br>
   <h2>Редактирование слайда</h2>

    <hr />
    <form class="form-horizontal" action="{{ route('slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.site.main.slider._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
