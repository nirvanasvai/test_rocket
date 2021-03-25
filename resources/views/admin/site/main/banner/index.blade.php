@extends('admin.layouts.app')

@section('title','Баннеры')

@section('content')

<div class="container-fluid">
    <br>
   <h2>Блок баннеры</h2>
    <br>
                    <div class="card">
                        <div class="card-body">
                            @if(Auth::user()->role==2)
                            <a href="{{ route('banner.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
                            @endif
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th class="text-center">Изображение</th>
                                        <th>Ссылка</th>
                                        <th class="text-right">Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($sliders as $slider)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="/storage/{{ $slider->image }}" alt="" width="100px;"></td>
                                            <td>{{$slider->url}}</td>
                                            <td class="text-right">
                                                <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('banner.destroy', $slider) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf

                                                    <a class="btn btn-primary" href="{{ route('banner.edit', $slider) }}"><i class="fa fa-edit"></i></a>

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
                    </div>
@endsection
