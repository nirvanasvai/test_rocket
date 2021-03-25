<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя Клиента</th>
                        <th class="text-center">Номер Телефона</th>
                        <th>Комментарий</th>
                        <th class="text-center">Дата</th>
                        <th class="text-center">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($callback as $call)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $call->name }}</td>
                            <td class="text-center">
                                {{$call->phone}}
                            </td>
                            <td><p>{{\Illuminate\Support\Str::limit(strip_tags($call->comment), $limit = 50, $end = '...')}}</p></td>
                            <td class="text-center">
                                {{ Date::parse($call->created_at)->format('j F в H:m') }}
                            </td>
                            <td class="text-right">
                                <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('call.destroy', $call) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-primary" href="{{ route('call.edit', $call) }}"><i class="fa fa-edit"></i></a>
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
