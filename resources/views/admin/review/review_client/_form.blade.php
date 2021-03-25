<div class="shadow card">
    <div class="card-header">

		@component('admin.components.check')
		@endcomponent

    </div>
</div>

@include('admin.components.message')

<div class="card mt-3">
	<div class="card-body">
        <div class="form-group">
            <label>Выберите Товар</label>
        </div>
        <div class="form-group">
            <label>Имя Клиента</label>
            <input type="text" class="form-control" name="name" placeholder="Имя" value="{{ $review->name ?? '' }}" required>
        </div>

        <div class="form-group">
            <label>Отзыв</label>
            <textarea type="text" class="form-control" name="review" required>{{$review->review ?? ''}}</textarea>
        </div>

        <div class="form-group">
            <label for="">Рейтинг</label>
            <select name="rating" id="" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>

            </select>

        </div>

        <div class="form-group">
            <label>Аватарка</label>
            <input type="file" class="form-control" name="image" value="{{ $review->image ?? '' }}">
        </div>
    </div>
</div>
