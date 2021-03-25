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
		        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#block" role="tab" aria-controls="block" aria-selected="true"><i class="fas fa-home"></i> Основные</a>
		    </li>
            <li class="nav-item">
                <a class="nav-link" id="meta-tab" data-toggle="tab" href="#meta" role="tab" aria-controls="meta" aria-selected="false"><i class="fab fa-html5"></i> Мета данные</a>
            </li>
		</ul>
	</div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="block" role="tabpanel" aria-labelledby="block-tab">

                <div class="input_wrapper">
                    <div class="input-wrapper">
                        <label for="image"></label>
                        <input class="form-control" type="text" name="name" placeholder="Введите текст" value="{{$brand->name ?? ''}}">
                    </div>
                </div>
                <div class="input_wrapper">
                    <div class="input-wrapper">
                        <label for="image">Логотип Бренда</label>
                        <input id="image" class="form-control" type="file" name="image" placeholder="Введите текст">
                    </div>

                    <div class="form-group">
                        <label>Описание</label>
                        <textarea type="text" class="form-control" name="description" id="descriptions" required>{{$brand->description ?? ''}}</textarea>
                    </div>
                    <input class="form-control" type="hidden" name="slug" placeholder="Автоматическая генерация" value="{{$brand->slug ?? ''}}" readonly="">


                </div>

            </div>
            <div class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">
                <div class="form-group">
                    <label for="">Мета заголовок</label>
                    <input type="text" class="form-control" name="meta_title" placeholder="Мета заголовок" value="{{ $brand->meta_title ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="">Мета описание</label>
                    <textarea class="form-control" id="meta_description" rows="4" name="meta_description">{{ $brand->meta_description ?? '' }}</textarea>
                </div>
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




