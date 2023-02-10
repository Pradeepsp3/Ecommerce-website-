@extends('master')
@section('title', 'Edit Product')
@section('main-content')
        <div class="text-center text-primary">

            <h2 class="">Edit Product</h2>

        </div>

        <div class="text-primary" style="display:flex;justify-content:center;">
            <form action="{{ url('admin/updateProduct/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="align-middle">
                    <label for="name" class="h5">Name</label>
                    <input type="text" name="product_name" class="form-control align-middle"
                        value="{{ $product->product_name }}">
                    @error('product_name')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div>
                    <label for="categoryType" class="h5">Category Type</label>
                    <select class="form-select" aria-label="Default select example" name="category_">
                        <optgroup>
                            <option value="{{ $product->category_id }}" selected>{{ $product->categoryName }}</option>
                        </optgroup>
                        <optgroup>
                            <option disabled>Select below to change Category</option>
                            <option disabled>-------------------------------</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                    @error('category_name')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="text-center">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                    <a href="{{ url('admin/viewProducts') }}" class="btn btn-info">Back</a>
                </div>
            </form>
        </div>
@endsection
