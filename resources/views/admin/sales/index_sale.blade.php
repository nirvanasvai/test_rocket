@extends('admin.layouts.app')

@section('title','Акции')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Страница акции</h2>

    <hr />
    <form class="form-horizontal" action="{{ url('admin/sale') }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="shadow card">
            <div class="card-header">

                <div class="row">
                    <div class="col-sm-6">
                    @if(!isset($data['page_type']))
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Назад</a>
                    @endif

                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">

            <div class="row">
                <div class="col-md-8">
                    <label>Название Блога</label>
                    <input type="text" class="form-control" name="title" placeholder="Заголовок" value="{{ $blog->title ?? '' }}" required>
                </div>
                <div class="col-md-4">
                    <label>Иконка в меню (30x30px)</label>
                    <input type="file" class="form-control" name="icon" placeholder="Иконка" value="{{ $blog->icon ?? '' }}" @if(!isset($blog->icon)) required @endif>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Заголовок Блога</label>
            <input type="text" class="form-control" name="name" placeholder="Заголовок" value="{{ $blog->name ?? '' }}" required>
        </div>
        <div class="form-group">
            <label>Фотография(980-300)</label>
            <input type="file" class="form-control" name="image" value="{{ $blog->image ?? '' }}">
        </div>
        <input class="form-control" type="hidden" name="slug" placeholder="Автоматическая генерация" value="{{$blog->slug ?? ''}}" readonly="">
    </div>

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
