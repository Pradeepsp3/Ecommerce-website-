@extends('master')
@section('title', 'View Products')
@section('main-content')
    <div class="text-center text-primary">
        <br>
        <h3>Products List</h3>
        <br>
    </div>
    @if ($message = Session::get('productUpdated'))
    <div class="alert alert-success container">
        {{ $message }}
        <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    @if ($message = Session::get('productDeleted'))
        <div class="alert alert-danger container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-8 container">
        <div class="float-right">
        <div class="form float-right d-flex justify-content-center">
            <form action="{{ url('admin/viewProducts') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search Product Name">
                    <input type="submit" value="search" class="btn btn-primary">
                </div>
            </form>
        </div>
        {{-- <div class="form float-right d-flex justify-content-center">
            <form action="{{ url('admin/viewProducts') }}" method="GET">
                <div class="input-group">
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option selected>Open this select menu</option>
                        @foreach ($categories as $category )
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </form>
        </div> --}}
    </div>
        <table class="table table-bordered text-center align-middle">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Category</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        {{-- @foreach ($categories as $category)
                            @if ($category->id === $product->category_id)
                                <td>{{ $category->category_name }}</td>
                            @endif
                        @endforeach --}}
                        <td>{{ $product->category_name }}</td>
                        <td><a href="{{ url('admin/editProduct/'.$product->id) }}" class="btn btn-warning">Edit</a> <a
                                href="{{ url('admin/deleteProduct/'.$product->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
