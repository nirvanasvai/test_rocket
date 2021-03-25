<div class="shadow card">
    <div class="card-header">

        <div class="row">
            <div class="col-sm-6">
                <a href="{{ url('/admin/partners_page?tab=block-tab') }}" class="btn btn-primary">Назад</a>
            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary float-right">Сохранить</button>
            </div>
        </div>

    </div>
</div>

@include('admin.components.message')

<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fas fa-home"></i> Блок с Картинками</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true"><i class="far fa-edit"></i> Основная Часть</a>
        </li>
    </ul>
</div>

<div class="card mt-3">
    <div class="card-body">

        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

                <div class="form-group">
                    <label>Заголовок</label>
                    <input type="text" class="form-control" name="title" placeholder="Заголовок" value="{{ $description->title ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Фотография для блока</label>
                    <input type="file" class="form-control" name="image" value="{{ $description->image ?? '' }}" @if(!isset($description->image)) required @endif>
                    @if(isset($description->image))
                        <img src="{{'/storage/'.$description->image}}" alt="" style="margin-top:10px;max-width:300px;">
                    @endif
                </div>
                <div class="form-group">
                    <label>Описание</label>
                    <textarea type="text" class="form-control" name="description" required>{{$description->description ?? ''}}</textarea>
                </div>
            </div>
            <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="form-group">
                    <label>Заголовок</label>
                    <input type="text" class="form-control" name="main_title" placeholder="Заголовок" value="{{ $description->main_title ?? '' }}" required>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8">
                            <label>Фотография для страницы</label>
                            <input type="file" class="form-control" name="main_image" value="{{ $description->main_image ?? '' }}" @if(!isset($description->main_image)) required @endif>
                            @if(isset($description->main_image))
                                <img src="{{'/storage/'.$description->main_image}}" alt="" style="margin-top:10px;max-width:300px;">
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label>Иконка для меню (30х30px)</label>
                            <input type="file" class="form-control" name="icon" value="{{ $description->icon ?? '' }}" @if(!isset($description->icon)) required @endif>
                            @if(isset($description->icon))
                                <img src="{{'/storage/'.$description->icon}}" alt="" style="margin-top:10px;max-width:300px;">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Описание</label>
                    <textarea type="text" class="form-control" name="main_description" id="descriptions" required>{{$description->main_description ?? ''}}</textarea>
                </div>
            </div>

        </div>

    </div>
</div>


