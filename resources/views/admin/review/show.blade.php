@extends('admin.layouts.app')

@section('title','Отзывы')

@section('content')
    
    <div class="container-fluid">
        <br>
        <h2>Отзывы</h2>
        <br>
        @include('admin.components.message')
        <div class="row">
            <div class="col-12">
                @include('admin.review.index')
            </div>

        </div>
    </div>

@endsection
