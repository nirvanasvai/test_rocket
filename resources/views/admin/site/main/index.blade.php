@extends('admin.layouts.app')

@section('title','Главная страница')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Главная страница</h2>
    <br>
       @include('admin.components.message')
       <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                <thead class="thead-dark">
                <tr>
                    <th>Название блока</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ 'Блок слайдер' }}</td>
                        <td >
                            <a class="btn btn-primary" href="{{ url('/admin/slider') }}"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ 'Блок услуги' }}</td>
                        <td >
                            <a class="btn btn-primary" href="{{ url('/admin/service') }}"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ 'Описание блока партнерам' }}</td>
                        <td >
                            <a class="btn btn-primary" href="{{ url('/admin/partner-block') }}"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ 'Блок партнерам' }}</td>
                        <td >
                            <a class="btn btn-primary" href="{{ url('/admin/description') }}"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>

                </tbody>

            </table>

</div>

@endsection
