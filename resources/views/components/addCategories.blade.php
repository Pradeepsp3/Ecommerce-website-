@extends('master')
@section('title', 'Add Category')
@section('main-content')
        <div class="text-center text-primary">

            <h2 class="">Add Categories</h2>

        </div>

        <div class="text-primary" style="display:flex;justify-content:center;">
            <form action="{{ url('admin/storeCategories') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row my-3 col-md-12 align-middle">
                    
                    <label for="name" class="h5 text-center">Name</label>
                    <input type="text" name="category_name" class="form-control align-middle" placeholder="Category Name">
                    @error('category_name')
                        <div class="error">{{ '*' . $message }}</div>
                    @enderror
                
                </div>
                <div class="text-center">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </div>

@endsection
