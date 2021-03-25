@extends('admin.layouts.app')

@section('title','Услуги')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Редактирование страницы</h2>
    <hr />
    <div>
        @include('admin.components.message')
    </div>
    <form class="form-horizontal" action="{{ url('/admin/service_page') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="shadow card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary float-right">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link @if(!isset($data['tab'])) active @endif" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fas fa-home"></i> Редактирование страницы</a>
                    </li>
                    <li class="nav-item @if(isset($data['tab'])) active @endif">
                        <a class="nav-link" id="block-tab" data-toggle="tab" href="#block" role="tab" aria-controls="block" aria-selected="false"><i class="fab fa-html5"></i> Редактирование блока</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="meta-tab" data-toggle="tab" href="#meta" role="tab" aria-controls="meta" aria-selected="false"><i class="fab fa-html5"></i> Мета данные</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade @if(!isset($data['tab'])) show active @endif" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="row">
                            <div class="col-md-8">
                            <div class="form-group">
                                <label>Название Страницы</label>
                                <input type="text" class="form-control" name="title_name" placeholder="Заголовок" value="{{ $about->title_name ?? '' }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Иконка в меню(32x32 px)</label>
                            <input type="file" class="form-control" name="icon" value="{{ $about->icon ?? '' }}" @if(!isset($about->icon)) required @endif>
                            @if(isset($about->icon))
                                <div class="form-group" style="position:relative;">
                                    <img src="/storage/{{ $about->icon }}" alt="" style="max-width:100px; width:100%;">
                                </div>
                            @endif
                        </div>
                        </div>
                        <div class="form-group">
                            <label>Фотография(1124x435)</label>
                            <input type="file" class="form-control" name="image" value="{{ $about->image ?? '' }}" @if(!isset($about->image)) required @endif>
                        </div>
                        @if(isset($about->image))
                            <div class="form-group" style="position:relative;">
                                <img src="/storage/{{ $about->image }}" alt="" style="max-width:600px; width:100%;">
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Описание блока</label>
                            <textarea class="form-control" name="description" >{{$about->description ?? ''}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Описание страницы</label>
                            <textarea class="form-control" name="advantages" id="descriptions">{{$about->advantages ?? ''}}</textarea>
                        </div>

                        <div class="form-group" hidden>
                            <label>Ссылка страницы</label>
                            <input type="text" class="form-control" name="slug" placeholder="url" value="{{ $about->slug ?? 'service' }}">
                        </div>

                    </div>
                        <div class="tab-pane fade @if(isset($data['tab'])) show active @endif" id="block" role="tabpanel" aria-labelledby="block-tab">

                            @include('admin.site.main.service.index')

                        </div>

                    <div class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">

                        <div class="form-group">
                            <label for="">Мета заголовок</label>
                            <input type="text" class="form-control" name="meta_title" placeholder="Мета заголовок" value="{{ $about->meta_title ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="">Мета описание</label>
                            <textarea class="form-control" id="meta_description" rows="4" name="meta_description">{{ $about->meta_description ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="text" hidden value="3" name="page_type">
    </form>

</div>





<input type="text" hidden value="2" name="page_type">

@endsection
