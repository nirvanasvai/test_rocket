@extends('admin.layouts.app')

@section('title','Товары')

@section('content')

<div class="container">

    @component('admin.components.breadcrumb')
        @slot('title') Импорт товаров @endslot
        @slot('parent') Главная @endslot
        @slot('active') Импорт изображений (.zip) @endslot
    @endcomponent

        @include('admin.components.message')

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('import_img_zip') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file">

                                <input type="submit" class="btn btn-success" value="Загрузить">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection