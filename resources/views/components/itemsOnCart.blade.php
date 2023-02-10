@extends('master')
@section('title', 'Items on customer cart')
@section('main-content')
    <div class="text-center text-primary">
        <br>
        <h3>Products on Customer Cart</h3>
        <br>
    </div>
    @if ($message = Session::get('movedToStock'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
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
                <th>Item Name</th>
                <th>Customer Name</th>
                <th>Product Description</th>
                <th>Quantity</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <td>{{ $cart->id }}</td>
                        <td>{{ $cart->item_name }}</td>
                        <td>{{ $cart->customer_name }}</td>
                        <td>{{ $cart->description }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td><a href="{{ url('admin/moveToStock/'.$cart->id) }}" class="btn btn-danger">Move to Stock</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
