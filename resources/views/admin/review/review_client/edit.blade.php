@extends('admin.layouts.app')

@section('title','Редактирование')

@section('content')

<div class="container">

    @component('admin.components.breadcrumb')
        @slot('title') Редактирование@endslot
        @slot('parent') Главная @endslot
        @slot('active') Редактирование Отзыва @endslot
    @endcomponent

    <hr />
    <form class="form-horizontal" action="{{ route('reviews.update', $review->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.review.review_client._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
