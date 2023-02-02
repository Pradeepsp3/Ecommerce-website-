@extends('master')
@section('title', 'Orders Processing')
@section('main-content')
    <div class="text-center text-primary">
        <br>
        <h3>Orders List</h3>
        <br>
    </div>
    @if ($message = Session::get('orderUpdated'))
        <div class="alert alert-success container">
            {{ $message }}
        </div>
    @endif
    <div class="col-md-10 container d-flex align-items-center justify-content-center">
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
                    @if ($order->order_status != 'Delivered')
                        <form action="{{ url('admin/updateOrder/' . $order->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <tr>
                                <th>{{ $order->invoice_no }}</th>
                                <th>{{ $order->user_id }}</th>
                                <th>{{ $order->customer_name }}</th>
                                <th>{{ $order->item_name }}</th>
                                <th>{{ $order->quantity }}</th>
                                <th>{{ $order->payment_mode }}</th>
                                <th><select name="orderStatus" id="">
                                        @if ($order->order_status == 'Pending')
                                            <option value="Pending" class="text-danger" selected>Pending</option>
                                        @else
                                            <option value="Pending" class="text-danger">Pending</option>
                                        @endif
                                        @if ($order->order_status == 'Confirmed')
                                            <option value="Pending" class="text-danger" selected>Confirmed</option>
                                        @else
                                            <option value="Pending" class="text-danger">Confirmed</option>
                                        @endif
                                        @if ($order->order_status == 'Processing')
                                            <option value="Pending" class="text-danger" selected>Processing</option>
                                        @else
                                            <option value="Processing" class="text-info">Processing</option>
                                        @endif
                                        @if ($order->order_status == 'Shipped')
                                            <option value="Pending" class="text-danger" selected>Shipped</option>
                                        @else
                                            <option value="Shipped" class="text-info">Shipped</option>
                                        @endif
                                        @if ($order->order_status == 'Delivered')
                                            <option value="Pending" class="text-danger" selected>Delivered</option>
                                        @else
                                            <option value="Delivered" class="text-success">Delivered</option>
                                        @endif
                                    </select></th>
                                <th>{{ $order->expected_delivery }}</th>
                                <th><input type="submit" class="btn btn-primary" value="Update"> <a href="{{ url('admin/viewOrderDetails/'.$order->id) }}" class="btn btn-info">View</a></th>
                            </tr>
                        </form>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
