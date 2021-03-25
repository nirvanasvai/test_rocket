@extends('admin.layouts.app')

@section('title','Информационные страницы')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Редактирование страницы</h2>
    <hr />
    @include('admin.components.message')
    <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('blog.update', $blog->id) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.blog._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
