<div class="shadow card">
    <div class="card-header">

		@component('admin.components.check')
		@endcomponent

    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card mt-3">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs">
		    <li class="nav-item">
		        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fas fa-home"></i> Основные</a>
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
					<label for="">Наименование</label>
					<input type="text" class="form-control" name="title" placeholder="Заголовок категории" value="{{ $category->title ?? '' }}" required>
				</div>
                <div class="form-group">
					<label for="">Что такое</label>
					<input type="text" class="form-control" name="sub_title" placeholder="Что такое" value="{{ $category->sub_title ?? '' }}">
				</div>
                <div class="form-group">
                    <label for="">Фотография к Основной Категории</label>
                    <input type="file" class="form-control" name="image" placeholder="Заголовок категории" >
                </div>
                <div class="form-group" style="display:none;">
                        <label for="" >Родительская категория</label>
                        <select class="form-control" name="parent_id" style="display:none;">
                            <option value="">-- без родительской категории --</option>
                            @foreach($categories as $item)
                                <option value="{{$item->id}}" @if(isset($select) && $item->id == $select) selected @endif>{{$item->title}}</option>
                            @endforeach
                        </select>
                        @error('parent')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('parent.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label>Описание для главной страницы</label>
                    <textarea type="text" class="form-control" name="description_short" required>{{$category->description_short ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label>Описание</label>
                    <textarea type="text" class="form-control" name="description" id="descriptions" required>{{$category->description ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label class="d-block">Выберите категории фильтров</label>
                    <select class="js-example-basic-multiple" name="filters[]" id="filters" multiple="multiple" placeholder="input input">
                                @foreach($filters as $item)
                                    <option value="{{$item->id}}" @if(isset($category) && $category->filters != NULL && in_array($item->id, json_decode($category->filters))) {{'selected'}} @endif>{{$item->title}}</option>
                                @endforeach
                        </select>
                </div>
		    </div>

            <input class="form-control" type="hidden" name="slug" placeholder="Автоматическая генерация" value="{{$blog->slug ?? ''}}" readonly="">

            <div class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">

				<div class="form-group">
					<label for="">Мета заголовок</label>
					<input type="text" class="form-control" name="meta_title" placeholder="Мета заголовок" value="{{ $category->meta_title ?? '' }}">
				</div>

				<div class="form-group">
					<label for="">Мета описание</label>
					<textarea class="form-control" id="meta_description" rows="4" name="meta_description">{{ $category->meta_description ?? '' }}</textarea>
				</div>
			</div>

        </div>

	</div>
</div>
