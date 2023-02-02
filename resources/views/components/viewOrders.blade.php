@extends('master')
@section('title', 'View Orders')
@section('main-content')
    <div class="text-center text-primary">
        <br>
        <h3>Orders List</h3>
        <br>
    </div>
    <div class="col-md-12 container d-flex align-items-center justify-content-center">
        <table class="table table-bordered text-center align-middle">
            <thead>
                <th>Invoice</th>
                <th>Customer Id</th>
                <th>Customer Name</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Payment Mode</th>
                <th>Order Status</th>
                <th>Expected Delivery Date</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th>{{ $order->invoice_no }}</th>
                        <th>{{ $order->user_id }}</th>
                        <th>{{ $order->customer_name }}</th>
                        <th>{{ $order->item_name }}</th>
                        <th>{{ $order->quantity }}</th>
                        <th>{{ $order->payment_mode }}</th>
                        <th class="text-info">{{ $order->order_status }}</th>
                        <th>{{ $order->expected_delivery }}</th>
                        <th><a href="{{ url('admin/viewOrderDetails/'.$order->id) }}" class="btn btn-info">View</a> <a href="{{ url('admin/ordersInProgress') }}" class="btn btn-warning">Edit</a></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
