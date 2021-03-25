@extends('admin.layouts.app')

@section('title','Страны')

@section('content')

<div class="container">

    @component('admin.components.breadcrumb')
        @slot('title') Список Стран @endslot
        @slot('parent') Главная @endslot
        @slot('active') Страны  @endslot
    @endcomponent
        @include('admin.components.message')

    <a href="{{ route('country.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>

    <table class="table table-striped">
        <thead class="thead-dark">
            <th>Наименование</th>
            <th class="text-center">Публикация</th>
            <th class="text-right">Действие</th>
        </thead>
        <tbody>
        @forelse ($countries as $country)
            <tr>
                <td>{{ $country->title }}</td>
                <td class="text-center">
                    <form id="published-form-{{ $country->id ?? '' }}" class="form-horizontal" action="{{route('country.update', $country)}}" method="post">
                        @method('PUT')
                        @csrf

                    </form>
                </td>
                <td class="text-right">
                    <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('country.destroy', $country) }}" method="post">
                    @method('DELETE')
                    @csrf

                    <a class="btn btn-primary" href="{{ route('country.edit', $brand) }}"><i class="fa fa-edit"></i></a>

                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
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
{{--                    {{ $categories->links() }}--}}
                </td>
            </tr>
        </tfoot>
    </table>

</div>

@endsection
