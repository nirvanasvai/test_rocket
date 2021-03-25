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
		        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fas fa-home"></i> Контакты</a>
		    </li>
		</ul>
	</div>
	<div class="card-body">

        <div class="form-group">
            <label>Номер Телефона</label>
            <input type="text" class="form-control" name="phone" placeholder="Номер Телефона" value="{{ $contact->phone ?? '' }}" required>
        </div>

        <div class="form-group">
            <label>Адрес</label>
            <input type="text" class="form-control" name="location" placeholder="Адрес" value="{{ $contact->location ?? '' }}" required>
        </div>
        <div class="form-group">
            <label>Почта</label>
            <input type="text" class="form-control" name="email" placeholder="Почта" value="{{ $contact->email ?? '' }}" required>
        </div>
        <div class="form-group">
            <label>График работы</label>
            <input type="text" class="form-control" name="date" placeholder="График работы" value="{{ $contact->email ?? '' }}" required>
        </div>

</div>
</div>





