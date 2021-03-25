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
                <label for="name">Имя Клиента</label>
                <input id='name' type="text" class="form-control" name="name" placeholder="Заголовок категории" value="{{ $call->name ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Номер Клиента</label>
                <input id='phone' type="text" class="form-control" name="phone" placeholder="Заголовок категории" value="{{ $call->phone ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea name="comment" id="comment" class="form-control" cols="30" rows="5">{{ $call->comment ?? '' }}</textarea>
            </div>
        </div>

</div>
</div>




