@extends('admin.layouts.app')

@section('title','Товары')

@section('content')

<div class="container-fluid">
    <br>
    <h2>Товары</h2>
    <hr />

        @include('admin.components.message')


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @if(Auth::user()->role==2)
                                    <a href="{{ route('product.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
                                    <a href="{{ route('import') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Импорт Excel</a>
                                    <a href="{{ route('import_zip') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Импорт Zip</a>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <form action="{{url('/admin/product')}}" method="GET" style="display: flex; justify-content: flex-end;">
                                        <div class="form-group">
                                            <select class="form-control" name="paginate" id="category" required onchange="this.form.submit()">
                                                <option value="">Количество строк</option>
                                                <option value="100" @if(isset($data['paginate']) && $data['paginate'] == '100') selected @endif>100</option>
                                                <option value="200" @if(isset($data['paginate']) && $data['paginate'] == '200') selected @endif>200</option>
                                                <option value="300" @if(isset($data['paginate']) && $data['paginate'] == '300') selected @endif>300</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="category_id" id="category" required onchange="this.form.submit()" style="margin-left:10px;">
                                                <option value="">Все категории</option>
                                                @forelse ($categories as $item)
                                                    <option value="{{$item->id}}" @if($item->childs->count() > 0) disabled @endif @if(isset($data['category_id']) && $data['category_id'] == $item->id) selected @endif>{{$item->title}}</option>
                                                    @if($item->childs)
                                                        @foreach($item->childs as $child)
                                                            <option value="{{$child->id}}" @if(isset($data['category_id']) && $data['category_id'] == $child->id) selected @endif>-- {{$child->title}}</option>
                                                        @endforeach
                                                    @endif
                                                @empty
                                                    <option value="">Нет категорий для выбора</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                    <tr>
                                        <th>Наименование</th>
                                        <th>Категория</th>
                                         <th>Видимость</th>
                                        <th class="text-right">Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>@if(isset($product->category_id)){{ $product->getCatalog->title }}@else Категория не выбрана @endif</td>
                                            <td class="text-center">
                                                <label class="checkbox-google">
                                                    <input type="checkbox" class="status_toggle status_update" data-id="{{$product->id}}" data-type="product" @if($product->status == 1) {{ 'checked' }} @endif>
                                                    <span class="checkbox-google-switch"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('product.destroy', $product) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf

                                                    <a class="btn btn-primary" href="{{ route('product.edit', $product) }}"><i class="fa fa-edit"></i></a>

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
                                {{$products->links('paginate')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      

@endsection
