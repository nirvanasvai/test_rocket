<div class="card-body">
    @if(Auth::user()->role==2)
    <a href="{{ route('color.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
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
            @forelse($colors as $color)
                <tr>
                    <td>{{ $color->name }}</td>
                    <td class="text-center">
                        <form id="published-form-{{ $color->id ?? '' }}" class="form-horizontal" action="{{route('color.update', $color)}}" method="post">
                            @method('PUT')
                            @csrf

                        </form>
                    </td>
                    @if(Auth::user()->role==2)
                    <td class="text-right">
                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('color.destroy', $color) }}" method="post">
                            @method('DELETE')
                            @csrf

                            <a class="btn btn-primary" href="{{ route('color.edit', $color) }}"><i class="fa fa-edit"></i></a>

                            @if(Auth::user()->role==2)
                                <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                            @endif
                        </form>
                    </td>
                        @endif
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

