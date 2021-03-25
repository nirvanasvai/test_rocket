@extends('admin.layouts.app')

@section('title','Категории')
@section('content')

<div class="container-fluid">
        <br>
        <h2>Список категорий</h2>
        <br>
        @include('admin.components.message')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            @if(Auth::user()->role==2)
                                @if(!$parent_id)
                                    <a href="{{ route('category.create') }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
                                @else
                                    <a href="{{ url('/admin/category') }}" class="btn btn-primary mb-2">Назад</a>
                                    <a href="{{ url('/admin/category/create?parent_id='.$parent_id) }}" class="btn btn-primary mb-2"><i class="far fa-plus-square"></i> Создать</a>
                                @endif
                            @endif
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                    <tr>
                                        <th>Наименование</th>
                                        <th class="text-center">Кол-во товаров</th>
                                        @if(!$parent_id)
                                        <th class="text-center" colspan="2">Подкатегории</th>
                                        @endif
                                        <th class="text-center">Видимость</th>
                                        <th class="text-right">Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($categories as $category)

                                        <tr>
                                            <td>{{ $category->title }}</td>
                                            
                                            <td class="text-center">
                                                @if(isset($category->childs) && $category->childs->count() > 0)
                                                    <?php $i = 0; ?>
                                                    @foreach($category->childs as $item)
                                                        <?php $i = $i + $item->products->count(); ?>
                                                    @endforeach
                                                    {{$i}}
                                                @else 
                                                    @if(isset($category->products) && $category->products->count() > 0)  
                                                        {{  $category->products->count()  }} 
                                                    @else 
                                                        {{'Нет товаров'}}  
                                                    @endif
                                                @endif
                                            </td>
                                            @if(!$parent_id)
                                            <td class="text-center">
                                               @if(isset($category->childs) && $category->childs->count() > 0)  {{ 'количество: '. $category->childs->count()  }} @else {{'Нет подкатегорий'}}  @endif
                                            </td>
                                            <td>
                                                <a href="/admin/category?parent_id={{$category->id}}">редактировать</a>
                                            </td>
                                            @endif
                                            <td class="text-center">
                                                <label class="checkbox-google">
                                                    <input type="checkbox" class="status_toggle status_update" data-id="{{$category->id}}" data-type="category" @if($category->status == 1) {{ 'checked' }} @endif>
                                                    <span class="checkbox-google-switch"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{ route('category.destroy', $category) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf

                                                    <a class="btn btn-primary" href="@if(!$parent_id) {{ route('category.edit', $category) }} @else {{ url('/admin/category/'.$category->id.'/edit?parent_id='.$parent_id) }} @endif"><i class="fa fa-edit"></i></a>

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

@endsection
