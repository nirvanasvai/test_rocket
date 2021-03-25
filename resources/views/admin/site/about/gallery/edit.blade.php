@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

<br>
<h2>Загрузить изображение</h2>

    <hr />

    <form class="form-horizontal" action="{{ route('gallery.update', $gallery->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.site.about.gallery._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
