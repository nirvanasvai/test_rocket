
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                            <tr>
                                <th>Имя Клиента</th>
                                <th>Отзыв</th>
                                <th class="text-center">Публикация</th>
                                <th class="text-right">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reviewClient as $review)
                                <tr>
                                    <td>{{ $review->name }}</td>
                                    <td>{{ $review->review }}</td>
                                    <td class="text-center">
                                        <form id="published-form-{{ $review->id ?? '' }}" class="form-horizontal" action="{{route('reviews.update', $review)}}" method="post">
                                            @method('PUT')
                                            @csrf

                                        </form>
                                    </td>
                                    <td class="text-right">
                                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('review.delete', $review) }}" method="post">
                                            @method('DELETE')
                                            @csrf

                                            <a class="btn btn-primary" href="{{ route('reviews.edit', $review) }}"><i class="fa fa-edit"></i></a>

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
        </div>
    </div>
</div>

