@extends('master')
@section('title', 'View Cart')
@section('main-content')
    <div class="gradient-custom" style="height:100vh">
        @if ($message = Session::get('lowCartValue'))
            <div class="alert alert-danger container">
                {{ $message }}
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($message = Session::get('highCartValue'))
            <div class="alert alert-danger container">
                {{ $message }}
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($message = Session::get('cartEmpty'))
            <div class="alert alert-danger container">
                {{ $message }}
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Cart - {{ $cartCount }} items</h5>
                        </div>
                        @foreach ($items as $item)
                            <div class="card-body">
                                <!-- Single item -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                        <!-- Image -->
                                        <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                            data-mdb-ripple-color="light">
                                            <img src="{{ asset($item->image) }}" class="w-100" alt="" />
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)">
                                                </div>
                                            </a>
                                        </div>
                                        <!-- Image -->
                                    </div>

                                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                        <!-- Data -->
                                        <p><strong>{{ $item->item_name }}</strong></p>
                                        <p>Product: </p>
                                        <p>Category: </p>
                                        <a type="button" href="{{ url('removeFromCart/' . $item->id) }}"
                                            class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                                            title="Remove Item">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                        <!-- Data -->
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                        <!-- Quantity -->
                                        <div class="d-flex mb-4" style="max-width: 300px">
                                            <a class="btn btn-primary px-3 me-2" id="quantityDown"
                                                href="{{ url('subtractFromCart/' . $item->id) }}">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </a>

                                            <div class="form-outline">
                                                <input id="quantity" min="1" name="quantity"
                                                    value="{{ $item->cartQuantity }}" type="number"
                                                    class="form-control text-center quantity" disabled />
                                                <label class="form-label" for="form1">Quantity</label>
                                            </div>
                                            <input type="hidden" value="{{ $item->quantity }}" id="stockQuantity">
                                            <a class="btn btn-primary px-3 ms-2" id="quantityUp"
                                                href="{{ url('addToCart/' . $item->id) }}">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <!-- Quantity -->

                                        <!-- Price -->
                                        <p class="text-start text-md-center">
                                            <strong id="price">&#8377. {{ $item->price }}/-</strong>
                                        </p>
                                        <!-- Price -->
                                        <!-- total price -->
                                        <p style="display:none;">{{ $total += $item->price * $item->cartQuantity }}</p>
                                    </div>
                                </div>
                                <!-- Single item -->

                                <hr class="my-4" />
                            </div>
                        @endforeach
                    </div>
                    {{-- <div class="card mb-4">
                        <div class="card-body">
                            <form class="p-2 d-flex justify-content-center align-items-center col-md-12">
                                @csrf
                                <div class="d-flex flex-row pb-3 col-md-4">
                                    <div class="d-flex align-items-center pe-2">
                                        <input class="form-check-input" type="radio" name="paymentMode" id="cardPayment"
                                            value="CardPayment" aria-label="..." disabled />
                                    </div>
                                    <div class="rounded border d-flex w-100 p-3 align-items-center">
                                        <p class="mb-0 text-dark">
                                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i> Credit/Debit Card
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex flex-row pb-3 col-md-4">
                                    <div class="d-flex align-items-center pe-2">
                                        <input class="form-check-input" type="radio" name="paymentMode" id="upi"
                                            value="UPI" aria-label="..." disabled />
                                    </div>
                                    <div class="rounded border d-flex w-100 p-3 align-items-center">
                                        <p class="mb-0 text-dark">
                                            <i class="fab fa-cc-mastercard fa-lg text-dark pe-2"></i> UPI
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex flex-row pb-3 col-md-4">
                                    <div class="d-flex align-items-center pe-2">
                                        <input class="form-check-input" type="radio" name="paymentMode" id="cod"
                                            value="COD" aria-label="..." checked />
                                    </div>
                                    <div class="rounded border d-flex w-100 p-3 align-items-center">
                                        <p class="mb-0 text-dark">
                                            <i class="fa fa-money" aria-hidden="true"></i> Cash on Delivery
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    <div class="card mb-4 d-flex">
                        <div class="card-body">
                            <p><strong>Ordered On</strong></p>
                            {{-- <p class="mb-0">{{ Date('Y-m-d H:i:s') }}</p> --}}
                            <p class="mb-0">{{ Carbon\Carbon::now()->tz('Asia/Kolkata')->toRfc850String() }}</p>
                        </div>
                        <div class="card-body">
                            <p><strong>Expected shipping delivery</strong></p>
                            <p class="mb-0">
                                {{ Carbon\Carbon::now()->addDays(10)->tz('Asia/Kolkata')->format('l d-F-Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Products
                                    <span>{{ $total }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Shipping
                                    <span>{{ $shipping }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total amount</strong>
                                        <strong>
                                            <p class="mb-0">(including VAT)</p>
                                        </strong>
                                    </div>
                                    <span><strong>{{ $total += $shipping }}</strong></span>
                                </li>
                            </ul>

                            <a href="{{ url('checkout/' . auth()->user()->id) }}"
                                class="btn btn-primary btn-lg btn-block">Proceed to Checkout</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <script>
    function checkQuantity() {
        var quantity = document.getElementById('quantity');
        if (quantity.value == 0) {
            $('.cartItemLow').modal('show');
            quantity.value = 1;
        }
        var stockQuantity = document.getElementById('stockQuantity');
        if (quantity.value > stockQuantity.value){
            $('.cartItemExceeds').modal('show');
            quantity.value = stockQuantity.value;
        }
    }
</script> --}}
