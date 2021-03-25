@include('admin.components.message')
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->role==2)
                    <a href="{{ route('review.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
                    @endif
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                            <tr>
                                <th>Наименование</th>
                                <th>Продукт</th>
                                <th>Оценка</th>
                                <th>Видимость</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reviews as $review)
                                <tr>
                                    <td>{{ $review->name }}</td>
                                    <td>
                                        <a href="{{'/product/'.$review->product->slug}}" target="_blank">{{$review->product->name}}</a>
                                    </td>
                                    <td class="text-center">{{ $review->rating }}</td>
                                    <td class="text-center">
                                        <label class="checkbox-google">
                                            <input type="checkbox" class="status_toggle status_update" data-id="{{$review->id}}" data-type="review" @if($review->status == 1) {{ 'checked' }} @endif>
                                            <span class="checkbox-google-switch"></span>
                                        </label>
                                    </td>
                                    <td >
                                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('review.destroy', $review) }}" method="post">
                                            @method('DELETE')
                                            @csrf

                                            <a class="btn btn-primary" href="{{ route('review.edit', $review) }}"><i class="fa fa-edit"></i></a>

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


