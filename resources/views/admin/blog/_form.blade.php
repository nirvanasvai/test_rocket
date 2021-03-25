<div class="shadow card">
    <div class="card-header">

        <div class="row">
            <div class="col-sm-6">
            @if(!isset($data['page_type']))
                <a href="{{ url()->previous() }}" class="btn btn-primary">Назад</a>
            @endif
                
            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary float-right">Сохранить</button>
            </div>
        </div>


    </div>
</div>


    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fas fa-home"></i> Основные</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true"><i class="far fa-edit"></i> Описание</a>
            </li>
        </ul>
    </div>

<div class="card mt-3">
	<div class="card-body">

		<div class="tab-content" id="myTabContent">

		    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

				<div class="form-group">
				    
				    <div class="row">
                        <div class="col-md-8">
                            <label>Название Блога</label>
                            <input type="text" class="form-control" name="title" placeholder="Заголовок" value="{{ $blog->title ?? '' }}" required>
                        </div>
                        <div class="col-md-4">
                            <label>Иконка в меню (30x30px)</label>
                            <input type="file" class="form-control" name="icon" placeholder="Иконка" value="{{ $blog->icon ?? '' }}" @if(!isset($blog->icon)) required @endif>
                        </div>
                    </div>
				</div>
                <div class="form-group">
                    <label>Заголовок Блога</label>
                    <input type="text" class="form-control" name="name" placeholder="Заголовок" value="{{ $blog->name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Фотография(980-300)</label>
                    <input type="file" class="form-control" name="image" value="{{ $blog->image ?? '' }}">
                </div>
                <input class="form-control" type="hidden" name="slug" placeholder="Автоматическая генерация" value="{{$blog->slug ?? ''}}" readonly="">
			</div>
            <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="form-group">
                    <label>Описание</label>
                    <textarea type="text" class="form-control" name="description" id="descriptions" required>{{$blog->description ?? ''}}</textarea>
                </div>
            </div>
            @if(isset($data['page_type']))
            <input type="text" hidden value="{{$data['page_type']}}" name="page_type">
            @endif
		</div>

	</div>
</div>


