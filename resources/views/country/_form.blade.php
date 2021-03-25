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
            <div class="input_wrapper">
                    <input type="text" name="name" placeholder="Введите текст">
                <br>
{{--                <button class="btn btn-success add_btn">Добавить</button>--}}
            </div>
        </div>

</div>
</div>
    <style>
        .input_wrapper input {
            display: block;
            margin-bottom: 20px;
        }
    </style>




