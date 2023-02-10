@extends('master')
@section('title', 'Orders List')
@section('main-content')
    <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Order Lists for, <span
                                    class="text-primary">{{ auth()->user()->name }}</span>!</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0 text-primary">Orders</p>
                            </div>
                            @foreach ($orders as $order )
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="small text-muted mb-0">Receipt Voucher : {{ $order->invoice_no }}</p>
                                <a href="{{ url('viewInvoice/'.$order->id) }}" class="small text-danger mb-0 mr-2 float-right"><i class="fa fa-file-text" aria-hidden="true"></i> Get Invoice</a>
                            </div>
                            <div class="card shadow-0 border mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset($order->item_image) }}"
                                                class="img-fluid" alt="Phone">
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0">{{ $order->item_name }}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">{{ $order->category_name }}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Qty: {{ $order->quantity }}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Payment Mode: {{ $order->payment_mode }}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">&#8377. {{ $order->item_price }}/-</p>
                                        </div>
                                    </div>
                                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-2">
                                            <p class="text-muted mb-0 small">Track Order</p>
                                        </div>
                                        <div class="col-md-10">
                                            @if ( $order->order_status == "Pending")
                                            <div class="progress" style="height: 6px; border-radius: 16px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: 0%; border-radius: 16px; background-color: rgb(73, 18, 224);"
                                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex justify-content-around mb-1">
                                                <p class="text-danger mt-1 mb-0 small ms-xl-5 col-md-8 d-flex justify-content-center">Pending</p>
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5 col-md-2">Delivered</p>
                                            </div>
                                            @elseif ( $order->order_status == "Confirmed")
                                            <div class="progress" style="height: 6px; border-radius: 16px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: 25%; border-radius: 16px; background-color: rgb(73, 18, 224);"
                                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex justify-content-around mb-1">
                                                <p class="text-warning mt-1 mb-0 small ms-xl-5 col-md-8 d-flex justify-content-center">Confirmed</p>
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5 col-md-2">Delivered</p>
                                            </div>
                                            @elseif ( $order->order_status == "Processing")
                                            <div class="progress" style="height: 6px; border-radius: 16px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: 40%; border-radius: 16px; background-color: rgb(73, 18, 224);"
                                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex justify-content-around mb-1">
                                                <p class="text-info mt-1 mb-0 small ms-xl-5 col-md-8 d-flex justify-content-center">Processing</p>
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5 col-md-2">Delivered</p>
                                            </div>
                                            @elseif ( $order->order_status == "Shipped")
                                            <div class="progress" style="height: 6px; border-radius: 16px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: 70%; border-radius: 16px; background-color: rgb(73, 18, 224);"
                                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex justify-content-around mb-1">
                                                <p class="text-info mt-1 mb-0 small ms-xl-5 col-md-8 d-flex justify-content-center">Shipped</p>
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5 col-md-2">Delivered</p>
                                            </div>
                                            @elseif ( $order->order_status == "Delivered")
                                            <div class="progress" style="height: 6px; border-radius: 16px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: 100%; border-radius: 16px; background-color: rgb(73, 18, 224);"
                                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex justify-content-around mb-1">
                                             <!--   <p class="text-info mt-1 mb-0 small ms-xl-5">Shipped</p> -->
                                                <p class="text-success mt-1 mb-0 small ms-xl-5 col-md-8 d-flex justify-content-center">Delivered</p>
                                                <p class="text-success mt-1 mb-0 small ms-xl-5 col-md-2 d-flex justify-content-center"></p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between pt-2">
                                <p class="fw-bold mb-0">Delivery Address</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Price</span> {{ $total += $order->item_price  }}</p>
                            </div>

                            <div class="d-flex justify-content-between pt-2">
                                <p class="text-muted mb-0">{{ $order->delivery_address }}</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">shipping</span> {{ $shipping *= $order->quantity }}</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="text-muted mb-0">Order Placed At : {{ $order->created_at }}</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4"></span></p>
                            </div>

                            <div class="d-flex justify-content-between mb-5">
                                <p class="text-muted mb-0">Expected Delivery At : {{ $order->expected_delivery }}</p>
                                <input type="hidden" value={{ $totalAmount = 0 }}>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> {{ $totalAmount = $total + $shipping  }}</p>
                            </div>
                            <hr class="hr hr-blurry" />
                            @endforeach
                        </div>
                       <!-- <div class="card-footer border-0 px-4 py-5 bg-secondary"
                            style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                                paid: <span class="h2 mb-0 ms-2">$1040</span></h5>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
