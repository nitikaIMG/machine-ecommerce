@php
    $product = isset($product) ? $product : new \App\Models\Product();
@endphp

@if ($category->children->isNotEmpty())
    @foreach ($category->children as $_category)
        @include('admin.product._categories', ['category' => $_category])
    @endforeach
@elseif( ! $category->is_root )
    <option data-id=@json($category->is_root) value="{{$category->id}}" {{$product->product_category_id == $category->id ? 'selected': ''}}>{{$category->title}}</option>
@endif