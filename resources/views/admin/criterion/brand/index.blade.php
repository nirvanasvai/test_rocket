<div class="card">
    <div class="card-body">
        @if(Auth::user()->role==2)
        <a href="{{ route('brand.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
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
                @forelse($brands as $brand)
                    <tr>
                        <td>{{ $brand->name }}</td>
                        <td class="text-center">
                            <form id="published-form-{{ $brand->id ?? '' }}" class="form-horizontal" action="{{route('brand.update', $brand)}}" method="post">
                                @method('PUT')
                                @csrf

                            </form>
                        </td>
                        <td class="text-right">
                            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('brand.destroy', $brand) }}" method="post">
                                @method('DELETE')
                                @csrf

                                <a class="btn btn-primary" href="{{ route('brand.edit', $brand) }}"><i class="fa fa-edit"></i></a>
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
