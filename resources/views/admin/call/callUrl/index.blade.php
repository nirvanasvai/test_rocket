<div class="card">
<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped table-bordered no-wrap">
            <thead>
            <tr>
                <th>Имя Клиента</th>
                <th class="text-center">Номер Телефона</th>
                <th class="text-center">Товар</th>
                <th class="text-center">Дата</th>
                <th>Деиствия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($callUrl as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">
                        {{$item->phone}}
                    </td>
                    <td><a href="{{'/product/'.$item->product->slug}}" target="_blank">{{$item->product->name}}</a></td>
                    <td class="text-center">
                        {{ Date::parse($item->created_at)->format('j F в H:m') }}
                    </td>
                    <td class="text-right">
                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('callUrl.destroy', $item) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <a class="btn btn-primary" href="{{ route('callUrl.edit', $item) }}"><i class="fa fa-edit"></i></a>


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

        </table>
    </div>
</div>
</div>
