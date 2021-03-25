<div class="shadow card">
    <div class="card-header">

		@component('admin.components.check')
		@endcomponent

    </div>
</div>

@include('admin.components.message')

    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fas fa-home"></i> Основные</a>
            </li>
        </ul>
    </div>

<div class="card mt-3">
	<div class="card-body">

		<div class="tab-content" id="myTabContent">

		    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

				<div class="form-group">
				    <label>Заголовок Услуг</label>
				    <input type="text" class="form-control" name="name" placeholder="Заголовок" value="{{ $service->name ?? '' }}" required>
				</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Фотография блока(62-62)</label>
                            <input type="file" class="form-control" name="image" value="{{ $service->image ?? '' }}">
                        </div>
                        @if(isset($about->image))
                            <div class="form-group" style="position:relative;">
                                <img src="/storage/{{ $about->image }}" alt="" style="max-width:600px; width:100%;">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Фотография на странице(1440x435 px)</label>
                            <input type="file" class="form-control" name="main_image" value="{{ $service->main_image ?? '' }}">
                        </div>
                        @if(isset($about->main_image))
                            <div class="form-group" style="position:relative;">
                                <img src="/storage/{{ $about->main_image }}" alt="" style="max-width:600px; width:100%;">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label>Описание Услуг</label>
                    <textarea type="text" class="form-control" name="description_title" id="descriptions" >{{$service->description_title ?? ''}}</textarea>
                </div>
			</div>

		</div>

	</div>
</div>


