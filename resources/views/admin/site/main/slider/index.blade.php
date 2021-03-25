@extends('admin.layouts.app')

@section('title','Слайдеры')

@section('content')

<div class="container-fluid">
    <br>
   <h2>Блок слайдер</h2>
    <br>

                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="index-tab" data-toggle="tab" href="#index" role="tab" aria-controls="index" aria-selected="true"><i class="far fa-address-book"></i> Контакты</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="meta-tab" data-toggle="tab" href="#meta" role="tab" aria-controls="meta" aria-selected="false"><i class="fab fa-html5"></i> Мета данные главной страницы</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="index" role="tabpanel" aria-labelledby="index-tab">
                                    @if(Auth::user()->role==2)
                                    <a href="{{ route('slider.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
                                    @endif
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                            <thead>
                                            <tr>
                                                <th>Наименование</th>
                                                <th class="text-center">Публикация</th>
                                                <th class="text-right">Действие</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($sliders as $slider)
                                                <tr>
                                                    <td>{{ $slider->title }}</td>
                                                    <td class="text-center">
                                                        <form id="published-form-{{ $slider->id ?? '' }}" class="form-horizontal" action="{{route('slider.update', $slider)}}" method="post">
                                                            @method('PUT')
                                                            @csrf

                                                        </form>
                                                    </td>
                                                    <td class="text-right">
                                                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('slider.destroy', $slider) }}" method="post">
                                                            @method('DELETE')
                                                            @csrf

                                                            <a class="btn btn-primary" href="{{ route('slider.edit', $slider) }}"><i class="fa fa-edit"></i></a>

                                                            @if(Auth::user()->role==2)
                                                                <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                    </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                                                </tr>
                                            @endforelse

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">
                                    <div class="container-fluid">
                                        <form class="form-horizontal" action="{{ url('/admin/home_page') }}" method="post" enctype="multipart/form-data" >

                                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                                <br>
                                            <input type="text" hidden value="6" name="page_type">
                                            <input type="text" hidden value="/" name="slug">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Мета заголовок</label>
                                                <input type="text" class="form-control" name="meta_title" placeholder="Мета заголовок" value="{{ $meta->meta_title ?? '' }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Мета описание</label>
                                                <textarea class="form-control" id="meta_description" rows="4" name="meta_description">{{ $meta->meta_description ?? '' }}</textarea>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
