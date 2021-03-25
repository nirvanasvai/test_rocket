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
                    <label>Фотография (330x600 px)</label>
                    <input type="file" class="form-control" name="image" value="{{ $slider->image ?? '' }}">
                    @if (isset($slider->image))
                        <img src="/storage/{{$slider->image}}" alt="" width="300px">
                    @endif
                </div>
				<div class="form-group">
                    <label>Ссылка</label>
                    <input type="text" class="form-control" name="url" value="{{ $slider->url ?? '' }}">
                </div>
			</div>

		</div>

	</div>
</div>
