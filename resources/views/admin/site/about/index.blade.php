@extends('admin.layouts.app')

@section('title',$about->title_name)

@section('content')

<div class="container-fluid">

    <br>
    <h2>О компании</h2>
    <br>
    @include('admin.components.message')

    @if(Auth::user()->role==2)
        <a href="{{ route('gallery.index') }}" class="btn btn-primary mb-2"><i class="fa fa-camera-retro fa-lg"></i> Галерея</a>
    @endif
    <table class="table table-striped table-borderless">
        <thead class="thead-dark">
            <th>Страница</th>

        </thead>
    </table>
    <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('about.update', $about->id) }}" method="post">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.site.about._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>
</div>

@endsection
