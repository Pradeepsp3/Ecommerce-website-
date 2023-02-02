@extends('master')
@section('title', $item->item_name)
@section('main-content')
    <div aria-label="breadcrumb" class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{ $category->category_name }}</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $product->product_name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $item->item_name }}</li>
        </ol>
    </div>
    <div class="container py-5">
        <form action=""></form>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card text-black">
                    <img class="card-img-top" src="{{ asset($item->image) }}" alt="" width="200px" height="250px">
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="card-title">{{ $item->item_name }}</h5>
                            <p class="text-muted mb-4">{{ $product->product_name }} {{ $category->category_name }}</p>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center">
                                <span>{{ $item->description }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between total font-weight-bold mt-4">
                            <span>Total</span><span>&#8377. <b id="amount">{{ $item->price }}</b>/-</span>
                        </div>
                        {{-- <div class="form-outline d-flex justify-content-between col-md-10">
                            <label class="form-label" for="typeNumber"><b>Quantity&nbsp;</b></label>
                            <input type="number" id="quantity" onclick="reviseAmount()" name='quantity'
                                class="form-control text-center" min="1" />
                        </div> --}}
                        <div class="d-flex align-items-center justify-content-center" style="padding:10px;">
                            <a href="{{ url('buynow/' . $item->id) }}" class="card-link btn btn-primary">Buy Now</a>
                            <a class="card-link btn btn-warning" href="{{ url('addToCart/' . $item->id) }}">Add Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <script>
    function reviseAmount() {
        var amount = JSON.parse("{!! json_encode($item->price) !!}");
        var quantity = document.getElementById('quantity');
        var total = amount * quantity.value;
        document.getElementById('amount').innerHTML = total;
    }
</script> --}}
