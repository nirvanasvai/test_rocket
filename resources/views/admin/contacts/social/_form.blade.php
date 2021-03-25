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

        <div class="form-group">
            <label>Instagram</label>
            <input type="text" class="form-control" name="instagram" placeholder="Заголовок" value="{{ $social->instagram ?? '' }}" >
        </div>

        <div class="form-group">
            <label>Facebook</label>
            <input type="text" class="form-control" name="facebook" placeholder="Заголовок" value="{{ $social->facebook ?? '' }}" >
        </div>
        <div class="form-group">
                    <label>What's app Номер</label>
                    <input type="text" class="form-control" name="whats_app" placeholder="What's app" value="{{ $social->whats_app ?? '' }}" >
                </div>

</div>
</div>





