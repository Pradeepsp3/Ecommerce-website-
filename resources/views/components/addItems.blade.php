@extends('master')
@section('title', 'Add Items')
@section('main-content')
    @if (auth()->user()->role_as == '1')
        <div class="text-center text-primary">

            <h2 class="">Add Items</h2>

        </div>

        <div class="text-primary" style="display:flex;justify-content:center;">
            <form action="{{ url('admin/storeItems') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="align-middle">

                    <label for="name" class="h5">Name</label>
                    <input type="text" name="item_name" class="form-control align-middle" placeholder="Item Name">
                    @error('item_name')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div>
                    <label for="categoryType" class="h5">Category Type</label>
                    <select class="form-select" id="categoryList" aria-label="Default select example" name="category_id">
                        <option selected disabled>Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div>
                    <label for="categoryType" class="h5">Product Type</label>
                    <select class="form-select" id="productList" aria-label="Default select example" name="product_id"
                        placeholder="select a product" disabled>
                        <option selected>Select a Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" class='parent-{{ $product->category_id }} product'>
                                {{ $product->product_name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="align-middle">
                    <label for="description" class="h5">Description</label>
                    <input type="text" name="description" class="form-control align-middle" placeholder="Description">
                    @error('description')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="">
                    <label for="image" class="form-label h5">Upload Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @error('image')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="align-middle">
                    <label for="price" class="h5">Price</label>
                    <input type="text" name="price" class="form-control align-middle" placeholder="999">
                    @error('price')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="text-center">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </div>
    @endif
@endsection
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#categoryList').on('change', function() {
            $("#productList").attr('disabled', false); //enable subcategory select
            $("#productList").val("");
            $(".product").attr('disabled', true); //disable all category option
            $(".product").hide(); //hide all subcategory option
            $(".parent-" + $(this).val()).attr('disabled',false); //enable subcategory of selected category/parent
            $(".parent-" + $(this).val()).show();
        });
    });
</script>
