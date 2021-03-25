<div class="shadow card">
    <div class="card-header">

		@component('admin.components.check')
		@endcomponent

    </div>
</div>
<div class="card mt-3">
	<div class="card-body">
        <div class="form-group">
            <label>Выберите Товар</label>
            <select class="form-control js-example-basic-multiple" name="product_id">
                {{--                    <option>--Без Категории--</option>--}}
                @foreach($products as $item)
                    <option value="{{$item->id}}" @if(isset($review->product_id) && $item->id == $review->product_id){{ 'selected' }} @endif>{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Имя Клиента</label>
            <input type="text" class="form-control" name="name" placeholder="Имя" value="{{ $review->name ?? '' }}" required>
        </div>
        <div class="form-group">
            <label>Фамилия Клиента</label>
            <input type="text" class="form-control" name="last_name" placeholder="Фамилия" value="{{ $review->last_name ?? '' }}" required>
        </div>
        <div class="form-group">
            <label>Отзыв</label>
            <textarea type="text" class="form-control" name="review" required>{{$review->review ?? ''}}</textarea>
        </div>

        <div class="form-group">
            <label for="">Рейтинг</label>
            <select name="rating" id="" class="form-control">
                <option value="1" @if(isset($review->rating) && $review->rating == 1){{ 'selected' }} @endif>1</option>
                <option value="2" @if(isset($review->rating) && $review->rating == 2){{ 'selected' }} @endif>2</option>
                <option value="3" @if(isset($review->rating) && $review->rating == 3){{ 'selected' }} @endif>3</option>
                <option value="4" @if(isset($review->rating) && $review->rating == 4){{ 'selected' }} @endif>4</option>
                <option value="5" @if(isset($review->rating) && $review->rating == 5){{ 'selected' }} @endif>5</option>

            </select>

        </div>

        <div class="form-group">
            <label>Аватарка</label>
            <input type="file" class="form-control" name="image" value="{{ $review->image ?? '' }}">
        </div>
    </div>
</div>
