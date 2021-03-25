@foreach ($categories as $category)

    <option value="{{$category->id or ""}}"

            @isset($product->id)
            @foreach ($product->categories as $category_product)
            @if ($category->id == $category_product->id)
            selected="selected"
        @endif
        @endforeach
        @endisset

    >
        {!! $delimiter or "" !!}{{$category->title or ""}}
    </option>

    @if (count($category->childs) > 0)

        @include('admin.product.partial.categories', [
          'categories' => $category->childs,
          'delimiter'  => ' - ' . $delimiter
        ])

    @endif
@endforeach
