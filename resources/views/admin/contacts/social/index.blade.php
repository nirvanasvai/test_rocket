
<div class="container-fluid">
    <a href="/admin/social/create" class="btn btn-primary"><i class="far fa-plus-square"></i> Добавить Новые Контакты</a>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                        <thead>
                        <tr>
                            <th>Instagram</th>
                            <th>Facebook</th>
                            <th>What's app Номер</th>
                            <th class="text-right">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($socials as $item)

                            <tr>
                                <td>{{ $item->instagram }}</td>
                                <td>{{ $item->facebook }}</td>
                                <td>{{ $item->whats_app }}</td>
                                <td class="text-right">
                                    <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('social.destroy', $item) }}" method="post">
                                        @method('DELETE')
                                        @csrf

                                        <a class="btn btn-primary" href="{{ route('social.edit', $item) }}"><i class="fa fa-edit"></i></a>
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
    </div>
</div>

