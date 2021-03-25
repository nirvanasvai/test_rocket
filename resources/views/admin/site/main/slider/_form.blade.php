<div class="shadow card">
    <div class="card-header">

		@component('admin.components.check')
		@endcomponent

    </div>
</div>

@include('admin.components.message')

<div class="card mt-3">
	<div class="card-body">

		<div class="tab-content" id="myTabContent">

		    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

				<div class="form-group">
				    <label>Заголовок Слайдера</label>
				    <input type="text" class="form-control" name="title" placeholder="Заголовок" value="{{ $slider->title ?? '' }}">
				</div>

                <div class="form-group">
                    <label>Описание</label>
                    <textarea type="text" class="form-control" name="description" >{{$slider->description ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label>Фотография (1410x500 px)</label>
                    <input type="file" class="form-control" name="image" value="{{ $slider->image ?? '' }}">
                </div>
				<div class="form-group">
                    <label>Ссылка</label>
                    <input type="text" class="form-control" name="url" value="{{ $slider->url ?? '' }}">
                </div>
			</div>

		</div>

	</div>
</div>
