@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <br>
    <h2>Пользователи</h2>
    <br>
    <a href="{{ route('user.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>

    <table class="table table-striped table-borderless">
        <thead class="thead-dark">
            <th>Имя</th>
            <th>Email</th>
            <th class="text-right">Действие</th>
        </thead>
        <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-right">
                    <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('user.destroy', $user) }}" method="post">
                        @method('DELETE')
                        @csrf

                        <a class="btn btn-primary" href="{{ route('user.edit', $user) }}"><i class="fa fa-edit"></i></a>

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
                    {{ $users->links() }}
                </td>
            </tr>
        </tfoot>
    </table>

</div>

@endsection
