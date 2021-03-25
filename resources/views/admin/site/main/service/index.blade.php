<div class="container-fuild">
    <div class="card">
        <div class="card-body">
            @if(Auth::user()->role==2)
            <a href="{{ route('service.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
            @endif
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                    <thead>
                    <tr>
                        <th>Наименование</th>
                        <th class="text-right">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td class="text-right">

                                    <a class="btn btn-primary" href="{{ route('service.edit', $service) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger" href="{{ url('/admin/link-service-delete/'.$service->id) }}"><i class="far fa-trash-alt"></i></a>


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
