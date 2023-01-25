@extends('master')
@section('title', 'View Products')
@section('main-content')
    <div class="text-center text-primary">
        <br>
        <h3>Products List</h3>
        <br>
    </div>
    <div class="col-md-8 container d-flex align-items-center justify-content-center">
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
                        @foreach ($categories as $category)
                            @if ($category->id === $product->category_id)
                                <td>{{ $category->category_name }}</td>
                            @endif
                        @endforeach
                        <td><a href="{{ url('admin/edit/'.$product->id) }}" class="btn btn-warning">Edit</a> <a
                                href="{{ url('admin/delete/'.$product->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
