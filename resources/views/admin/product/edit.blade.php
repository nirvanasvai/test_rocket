@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <br>
    <h2>Редактирование товара</h2>
    <hr />
    @if(Request::is('admin/product*edit'))
        <div class="form-group">
            <label class="mb-2">Фотографии</label>
            <br>
            <label class="mb-4">Удалите картинке перед тем как редактировать!</label>
            <br>
            <div class="row m-0">
            @foreach ($product->childrenImg as $image)
                <div class="d-flex mr-4">
                    <img src="/storage/test/{{ isset($image->image) ? $image->image : null}}" alt="" width="70px" height="70px"><form method="post" action="{{ route('product-image-delete', $image->id) }}">
                        @csrf
                        <button class="btn-info ml-1">Х</button> </form>
                </div>
            @endforeach
        </div>

        </div>
    @endif
    <form class="form-horizontal" action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        {{-- Form include --}}
        @include('admin.product._form')

        <input type="hidden" name="modified_by" value="{{ Auth::id() }}">
    </form>

</div>

@endsection
