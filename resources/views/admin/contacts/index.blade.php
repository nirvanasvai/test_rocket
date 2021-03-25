@extends('admin.layouts.app')

@section('title','Контакты')

@section('content')
<div class="container-fluid">
    <br>
    <h2>
        Контакты
    </h2>

    @include('admin.components.message')


                <div class="card mt-3">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true"><i class="far fa-address-book"></i> Контакты</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false"><i class="fab fa-instagram"></i> Социльаные Сети</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="meta-tab" data-toggle="tab" href="#meta" role="tab" aria-controls="meta" aria-selected="false"><i class="fab fa-html5"></i> Мета данные страницы</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                            @include('admin.contacts.info.index')
                        </div>
                        <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                            @include('admin.contacts.social.index')
                        </div>
                        <div class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">
                            <div class="container-fluid">
                            <form class="form-horizontal" action="{{ url('/admin/contact_page') }}" method="post" enctype="multipart/form-data" >

                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                    <br>
                                <input type="text" hidden value="5" name="page_type">
                                <input type="text" hidden value="contact" name="slug">
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
