@extends('admin.layouts.app')

@section('title','Галерея')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Галерея</h2>
    <br>
       @include('admin.components.message')
       <a href="{{ url('admin/about') }}" class="btn btn-primary mb-2">Назад</a>
        @if(Auth::user()->role==2)
            <a href="{{ route('gallery.create') }}" class="btn btn-primary mb-2"><i class="fa fa-camera-retro fa-lg"></i> Загрузить</a>
        @endif
    <hr>
    <div class="row">
        @forelse ($gallery as $item)
            <div class="col-md-3" style="margin-bottom:5px;">
                <div style="display:inline-block;margin-right:5px;">
                    <img src="/images/gallery/{{$item->image}}" alt="" style="max-width:200px; height:auto;">
                </div>
                <div style="display:inline-block;">
                    <a class="btn btn-primary" href="{{ route('gallery.edit', $item) }}"><i class="fa fa-edit"></i></a>
                    <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('gallery.destroy', $item) }}" method="post">
                        @method('DELETE')
                        @csrf
                        @if(Auth::user()->role==2)
                            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        @endif
                    </form>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <h2>Данные отсутствуют</h2>
            </div>
        @endforelse
    </div>
        
</div>

@endsection
