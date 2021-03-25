@extends('admin.layouts.app')

@section('title','О нас')

@section('content')

<div class="container-fluid">

    <br>
    <h2>Блок партнерам</h2>
    <br>
       @include('admin.components.message')
       <a href="{{url('/admin/partners_page?tab=block-tab')}}" class="btn btn-primary mb-2"> Назад</a>
        @if(Auth::user()->role==2)
            <a href="{{ route('description.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
        @endif
    <table class="table table-striped table-borderless">
        <thead class="thead-dark">
            <th>Наименование</th>
            <th class="text-center">Публикация</th>
            <th class="text-right">Фотографии</th>
            <th class="text-right"></th>
            <th class="text-right">Действие</th>
        </thead>
        <tbody>
        @forelse ($descriptions as $description)
            <tr>
                <td>{!!$description->title !!}</td>
                <td class="text-center">
                    <form id="published-form-{{ $description->id ?? '' }}" class="form-horizontal" action="{{route('description.update', $description)}}" method="post">
                        @method('PUT')
                    </form>
                </td>
                <td>
                    <img src="/storage/{{$description->image}}" alt="" width="70px" height="70px">
                </td>
                <td class="text-right">
                    <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('description.destroy', $description) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <a class="btn btn-primary" href="{{ route('description.edit', $description) }}"><i class="fa fa-edit"></i></a>

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
        <tfoot>
            <tr>
                <td colspan="3">
{{--                    {{ $articles->links() }}--}}
                </td>
            </tr>
        </tfoot>
    </table>

</div>

@endsection
