@extends('admin.layouts.app')

@section('title','Редактирование')

@section('content')

<div class="container-fluid">
    <br>
    <h2>Редактирование Отзыва</h2>
    <hr />
    <form class="form-horizontal" action="{{ route('review.update', $review->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.review._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
