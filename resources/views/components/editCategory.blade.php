@extends('master')
@section('title', 'View Categories')
@section('main-content')
<div class="text-center text-primary">

    <h2 class="">Edit Category</h2>

</div>
<div class="text-primary" style="display:flex;justify-content:center;">
    <form action={{ url('admin/updateCategory/'.$category->id) }} method="post" enctype="multipart/form-data" id="formAction">
        @csrf
        @method('put')
        <div class="row my-3 col-md-12 align-middle">

            <label for="name" class="h5 text-center">Name</label>
            <input type="text" name="category_name" class="form-control align-middle" value="{{ $category->category_name }}">
            @error('category_name')
                <div class="error">{{ '*' . $message }}</div>
            @enderror

        </div>
        <div class="text-center">
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            <a href="{{ url('admin/viewCategories') }}" class="btn btn-info">Back</a>
        </div>
    </form>
</div>
@endsection
