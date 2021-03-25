@extends('admin.layouts.app')

@section('title','Информационные страницы')

@section('content')

<div class="container-fluid">
    <br>
    <h2>Информационные страницы</h2>
    <br>
       @include('admin.components.message')

        @if(Auth::user()->role==2)
    <a href="{{ route('blog.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
        @endif

    <table class="table table-striped table-borderless">
        <thead class="thead-dark">
            <th>Наименование</th>
            <th>Фотографии</th>
            <th>Действие</th>
        </thead>
        <tbody>
        @forelse ($blogs as $blog)
            <tr>
                <td>{{$blog->title}}</td>
                <td>
                    <img src="/storage/{{$blog->image}}" alt="" width="100px" height="auto">
                </td>
                <td>
                    <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('blog.destroy', $blog) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <a class="btn btn-primary" href="{{ route('blog.edit', $blog) }}"><i class="fa fa-edit"></i></a>

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
