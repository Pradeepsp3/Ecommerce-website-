@extends('master')
@section('title', 'Edit Items')
@section('main-content')
    @if (auth()->user()->role_as == '1')
        <div class="text-center text-primary">

            <h2 class="">Edit Items</h2>

        </div>

        <div class="text-primary" style="display:flex;justify-content:center;">
            <form action="{{ url('admin/updateItem/'.$item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("patch")
                <div class="align-middle">

                    <label for="name" class="h5">Name</label>
                    <input type="text" name="item_name" class="form-control align-middle" value="{{ $item->item_name }}">
                    @error('item_name')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div>
                    <label for="categoryType" class="h5">Category Type</label>
                    <select class="form-select" id="categoryList" aria-label="Default select example" name="category_id">
                        <optgroup>
                        <option value ="{{ $itemCategory->id }}" selected>{{ $itemCategory->category_name }}</option>
                    </optgroup>
                    <optgroup>
                        <option class="text-info" disabled>Select below to change product or category</option>
                        <option disabled>__________________________________________</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </optgroup>
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
                        <option selected>{{ $itemProduct->product_name }}</option>
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
                    <input type="text" name="description" class="form-control align-middle" value="{{ $item->description }}">
                    @error('description')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="">
                    <label for="image" class="form-label h5">Upload Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" value="{{ $item->image }}">
                    @error('image')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="align-middle">
                    <label for="price" class="h5">Price</label>
                    <input type="text" name="price" class="form-control align-middle" value="{{ $item->price }}">
                    @error('price')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="align-middle">
                    <label for="quantity" class="h5">Quantity</label>
                    <input type="number" name="quantity" class="form-control align-middle" value="{{ $item->quantity }}" min="1">
                    @error('price')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="text-center">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    @endif
@endsection
