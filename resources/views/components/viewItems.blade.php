@extends('master')
@section('title', 'View Items')
@section('main-content')
    <div class="text-center text-primary">
        <br>
        <h3>Items List</h3>
        <br>
    </div>
    <div class="col-md-8 container d-flex align-items-center justify-content-center">
        <table class="table table-bordered text-center align-middle">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Category</th>
                <th>Product</th>
                <th>Description</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->item_name }}</td>
                        @foreach ($categories as $category)
                            @if ($category->id === $item->category_id)
                                <td>{{ $category->category_name }}</td>
                            @endif
                        @endforeach
                        @foreach ($products as $product)
                            @if ($product->id === $item->product_id)
                                <td>{{ $product->product_name }}</td>
                            @endif
                        @endforeach
                        <td>{{ $item->description }}</td>
                        <td><a href="{{ url('admin/edit/'.$item->id) }}" class="btn btn-warning">Edit</a> <a
                                href="{{ url('admin/delete/'.$item->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
