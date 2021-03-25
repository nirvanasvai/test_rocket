@extends('admin.layouts.app')


@section('content')
<div class="container">
    <a href="{{ route('create-zip',['download'=>'zip']) }}" class="btn btn-info" >Download ZIP</a>
</div>

@endsection
