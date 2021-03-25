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
		</ul>
	</div>
	<div class="card-body">

        <div class="container pt-5">
            <div class="form-group">
                <label for="">Наименование</label>
                <input type="text" class="form-control" name="title" placeholder="Заголовок категории" value="{{ $filter->title ?? '' }}" required>
            </div>
            <div class="input-wrapper-filter">
                @if(isset($filter->item))
                    @foreach($filter->item as $item)
                        <div data-id="{{$item->id}}" class="row row_input">
                            <div class="col-md-4">
                                <label>Значение #{{$loop->iteration}}</label>
                                <input class="form-control mb-3 val input_ajax_update" data-input="{{$item->id}}" type="text" name="title_item[]" placeholder="Введите Значение" value="{{$item->title_item}}">
                            </div>
                            <div class="col-md-2">
                                <label>Действие</label>
                                <a href="/admin/api-delete-position/{{$item->id}}" class="btn btn-danger delete_btn_api have_id">
                                    Удалить
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <button class="btn btn-success add_filter_btn">Добавить значение</button>
        </div>

</div>
</div>
    <style>
        .input_wrapper input {
            display: block;
            margin-bottom: 20px;
        }
    </style>




