@extends('master')
@section('title', 'View Order Details')
@section('main-content')
<div class="text-center text-success">
    <br>
    <h3>Order Details for Invoice: <span class="text-info">{{ $order->invoice_no }}</span></h3>
    <br>
</div>
<div class="container">
    <table class="table table-bordered text-center align-middle">
        <tbody>
            <tr>
                <th class="font-weight-bold" colspan="2">Customer Id</th>
                <td colspan="2">{{ $order->user_id }}</td>
            </tr>
            <tr>
                <th colspan="2">Customer Name</th>
                <td colspan="2">{{ $order->customer_name }}</td>
            </tr>
            <tr>
                <th colspan="2">Item Ordered</th>
                <td colspan="2">{{ $order->item_name }}</td>
            </tr>
            <tr>
                <th colspan="2">Quantity</th>
                <td colspan="2">{{ $order->quantity }}</td>
            </tr>
            <tr>
                <th colspan="2">Contact No</th>
                <td colspan="2">{{ $order->contact_no }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td colspan="3">{{ $order->delivery_address }}</td>
            </tr>
            <tr>
                <th>Order Price</th>
                <td>{{ $order->total_amount }}</td>
                <th>Payment Status</th>
                <td>{{ $order->payment_mode }}</td>
            </tr>
            <tr>
                <th>Order Status</th>
                <td>{{ $order->order_status }}</td>
                @if ($order->order_status == "Delivered")
                <th>Delivered Date</th>
                <td>{{ $order->expected_delivery }}</td>
                @else
                <th>Expected Delivery Date</th>
                <td>{{ $order->expected_delivery }}</td>
                @endif
            </tr>
            <tr>
                <th>Order Placed Date</th>
                <td>{{ $order->created_at }}</td>
                <th>Last Updated Date</th>
                <td>{{ $order->updated_at }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
