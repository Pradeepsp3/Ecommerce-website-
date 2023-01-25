@extends('master')
@section('title', 'Add Products')
@section('main-content')
    @if (auth()->user()->role_as == '1')
        <div class="text-center text-primary">

            <h2 class="">Add Products</h2>

        </div>

        <div class="text-primary" style="display:flex;justify-content:center;">
            <form action="{{ url('admin/storeProducts') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="align-middle">
                    
                    <label for="name" class="h5">Name</label>
                    <input type="text" name="product_name" class="form-control align-middle" placeholder="Product Name">
                    @error('product_name')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                </div>
                <br>
                <div>
                    <label for="categoryType" class="h5">Category Type</label>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected>Open this select menu</option>
                        @foreach ($categories as $category )
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>  
                    @error('category_id')
                    <div class="error">{{ '*' . $message }}</div>
                @enderror  
                </div>
                <br>
                <div class="text-center">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </div>
    @endif
@endsection
