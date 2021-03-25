<style>
    .custom-file-input{
        opacity: 1;
        margin-left: -15px;
    }

    .custom-file-input::-webkit-file-upload-button {
        visibility: hidden;
    }
    .custom-file-input::before {
        content: 'Выберите иконку';
        display: inline-block;
        background: linear-gradient(top, #f9f9f9, #e3e3e3);
        border:1px solid #e9ecef;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        white-space: nowrap;
        -webkit-user-select: none;
        cursor: pointer;
        text-shadow: 1px 1px #fff;
        font-weight: 500;
        font-size: 15.5px;
    }
    .custom-file-input:hover::before {
        border-color: black;
    }
    .custom-file-input:active::before {
        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
    }

</style>

<div class="shadow card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-6">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Назад</a>
            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary float-right">Сохранить</button>
            </div>
        </div>

    </div>
</div>

@include('admin.components.message')

<div class="card mt-3">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs">
		    <li class="nav-item">
		        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fas fa-home"></i> Основные</a>
		    </li>
		    <li class="nav-item">
		        <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true"><i class="far fa-edit"></i> Описание</a>
		    </li>
            <li class="nav-item">
                <a class="nav-link" id="feature-tab" data-toggle="tab" href="#feature" role="tab" aria-controls="feature" aria-selected="true"><i class="fas fa-archive"></i>Характеристики</a>
            </li>
		    <li class="nav-item">
		        <a class="nav-link" id="meta-tab" data-toggle="tab" href="#meta" role="tab" aria-controls="meta" aria-selected="false"><i class="fab fa-html5"></i> Мета данные</a>
		    </li>
		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content" id="myTabContent">

		    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="form-group">
                    <label>Категория</label>
                    <select class="form-control" name="category_id" required>
                        <option value="">--Выберите категорию--</option>

                        @foreach($categories as $category)

                            <option value="{{$category->id}}" {{ ($category->childs()->count() > 0) ? 'disabled style=background:#d3d3d3' : '' }} @if((isset($product->category_id) && $product->category_id == $category->id)){{  'selected' }} @endif >{{$category->title}} - основной раздел</option>
                            @foreach($category->childs as $item)
                                <option value="{{$item->id}}" @if((isset($product->category_id) && $product->category_id == $item->id)){{  'selected' }} @endif>-- {{$item->title}}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
				    <label>Название</label>
				    <input type="text" class="form-control" name="name" placeholder="Заголовок" value="{{ $product->name ?? '' }}" required>
				</div>

                <div class="form-group">
                    <label>Артикул</label>
                    <input type="text" class="form-control" name="article" placeholder="Введите артикул" value="{{ $product->article ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Цена</label>
                    <input type="text" class="form-control" name="price" placeholder="Введите цену" value="{{ $product->price ?? '' }}" >
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sale" value="1" id="flexCheckDefault" @if(isset($product) && $product->sale == 1) {{ 'checked'}} @endif>
                        <label class="form-check-label" for="flexCheckDefault">
                            Акция
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Фотография</label>
                    <input type="file" class="form-control" name="image[]"  multiple="multiple" value="{{ $product->image ?? '' }}">
                </div>
                <div class="form-group">
                    <label>Страна производства</label>
                    <select class="form-control" name="country_id" required>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}" {{ (isset($product->country_id) && ($country->id == $product->country_id)) ? 'selected' : '' }}>{{$country->name}}</option>

                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Бренд</label>
                    <select class="form-control" name="brand_id" required>
                        @foreach($brands as $brand)

                            >{{$brand->name}}</option>
                            <option value="{{$brand->id}}" {{ (isset($product->brand_id) && ($brand->id == $product->brand_id)) ? 'selected' : '' }}

                            >{{$brand->name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Цвет</label>
                    <select class="form-control" name="color_id"   required>
                        @foreach($colors as $color)

                            <option value="{{$color->id}}">{{$color->name}}</option>

                        @endforeach
                    </select>
                </div>
                @if ($filters)
                    <div class="form-group">
                        <label>Фильтры</label>

                        <select class="form-control js-example-basic-multiple" name="filters[]" multiple="multiple" >
                            @foreach($filters as $filter)
                                <optgroup label="{{$filter->title}}">
                                    @foreach($filter->item as $item)
                                            <option value="{{$item->id}}" @if(isset($relation) && in_array($item->id, $relation)) {{'selected'}} @endif>{{$item->title_item}}</option>
                                        @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                @endif

		    </div>

		    <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">

				<div class="form-group">
					<label for="">Характеристики</label>
					<textarea class="form-control summernote" id="specifications" rows="4" name="specifications">{{ $product->specifications ?? ''}}</textarea>
				</div>
                <div class="form-group">
					<label for="">Преимущества</label>
					<textarea class="form-control summernote" id="benefits" rows="4" name="benefits">{{ $product->specifications ?? ''}}</textarea>
				</div>

				<div class="form-group">
					<label for="">Описание</label>
					<textarea class="form-control summernote" id="descriptions" rows="6" name="description">{{ $product->description ?? '' }}</textarea>
				</div>

		    </div>

            <div class="tab-pane fade" id="feature" role="tabpanel" aria-labelledby="feature-tab">
                <div class="container pt-5 feature-rows">
                    <div class="input-wrapper">
                        @if(isset($feature))
                            @foreach($feature as $item)

                                    <div class="row row_input">
                                        <input class="val" type="text" hidden name="features_id[]" value='{{$item->id}}'>
                                        <div class="col-md-4">
                                            <label>Название</label>
                                            <input class="form-control mb-3" type="text" name="test[title][{{$item->id}}]" placeholder="Введите Название" value="{{$item->title}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Значение</label>
                                            <input class="form-control mb-3" type="text" name="test[title_name][{{$item->id}}]" placeholder="Введите Значение" value="{{$item->title_name}}">
                                        </div>
                                        <div class="col-md-2">
                                            <label>Иконка</label>
                                            <input type="file" name="test[icon][{{$item->id}}]" class="custom-file-input" value="{{$item->icon}}">
                                        </div>
                                        <div class="col-md-2">
                                            <label>Действие</label>
                                           <a href="#" class="btn btn-danger delete_btn">
                                                Удалить
                                            </a>
                                        </div>
                                    </div>
                            @endforeach
                        @endif
                    </div>
                        <br>
                    <button class="btn btn-success add_btn">Добавить</button>
                </div>
            </div>

			<div class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">

				<div class="form-group">
					<label for="">Мета заголовок</label>
					<input type="text" class="form-control" name="meta_title" placeholder="Мета заголовок" value="{{ $product->meta_title ?? '' }}">
				</div>

				<div class="form-group">
					<label for="">Мета описание</label>
					<textarea class="form-control" id="meta_description" rows="4" name="meta_description">{{ $product->meta_description ?? '' }}</textarea>
				</div>

                <input class="form-control" type="hidden" name="slug" placeholder="Автоматическая генерация" value="{{$blog->slug ?? ''}}" readonly="">

			</div>

		</div>

	</div>
</div>
