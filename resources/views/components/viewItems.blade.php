@extends('master')
@section('title', 'View Items')
@section('main-content')
    <div class="text-center text-primary">
        <br>
        <h3>Items List</h3>
        <br>
    </div>
    @if ($message = Session::get('itemUpdated'))
        <div class="alert alert-success container">
            {{ $message }}
        </div>
    @endif
    @if ($message = Session::get('itemDeleted'))
        <div class="alert alert-danger container">
            {{ $message }}
        </div>
    @endif
    <div class="col-md-8 container">
        <div class="form float-right d-flex justify-content-center">
            <form action="{{ url('admin/viewItems') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search Item Name">
                    <input type="submit" value="search" class="btn btn-primary">
                </div>
            </form>
        </div>
        <table class="table table-bordered text-center align-middle">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Category</th>
                <th>Product</th>
                <th>Description</th>
                <th>Quantity</th>
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
                        <td>{{ $item->quantity }}</td>
                        <td><a href="{{ url('admin/editItem/'.$item->id) }}" class="btn btn-warning">Edit</a> <a
                                href="{{ url('admin/deleteItem/'.$item->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
