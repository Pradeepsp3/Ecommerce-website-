@extends('master')
@section('title', 'Place Order Page')
@section('main-content')
<form action="{{ url('placeOrder') }}" method="POST">
    @csrf
<div class="card">
    <div class="card-body">
      <div class="container mb-5 mt-3">
        <div class="row d-flex align-items-baseline">
          <div class="col-xl-9">
            <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #E-Com-{{ $invoiceNo }}</strong></p>
            <input type="hidden" name="invoiceNo" value="#E-Com-{{ $invoiceNo }}">
          </div>
          <div class="col-xl-3 float-end">
            <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                class="fas fa-print text-primary"></i> Print</a>
            <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                class="far fa-file-pdf text-danger"></i> Export</a>
          </div>
          <hr>
        </div>

        <div class="container">
          <div class="col-md-12">
            <div class="text-center">
                <i class="fa fa-chevron-up" aria-hidden="true"></i>
              <p class="pt-0">Ecommerce</p>
            </div>

          </div>


          <div class="row">
            <div class="col-xl-8">
              <ul class="list-unstyled">
                <li class="text-muted">To: <span style="color:#5d9fc5 ;">{{ $user->name }}</span></li>
                <li class="text-muted">{{ $user->address }}{{ $user->address2 }},</li>
                <li class="text-muted">{{ $user->city }},{{ $user->state }}, {{ $user->country }}-{{ $user->zipcode }}</li>
                <li class="text-muted"><i class="fa fa-phone-square" aria-hidden="true"></i> {{ $user->phone }}</li>
              </ul>
            </div>
            <div class="col-xl-4">
              <p class="text-muted">Invoice</p>
              <ul class="list-unstyled">
                <li class="text-muted"><i class="fa fa-caret-right" aria-hidden="true"></i> <span
                    class="fw-bold">ID:</span>#E-Com-{{ $invoiceNo }}</li>
                <li class="text-muted"><i class="fa fa-caret-right" aria-hidden="true"></i> <span
                    class="fw-bold">Creation Date: </span>{{ Carbon\Carbon::now()->tz('Asia/Kolkata')->format('d-F-Y') }}</li>
                    <li class="text-muted"><i class="fa fa-caret-right" aria-hidden="true"></i> <span
                        class="me-1 fw-bold">Payment Mode:</span><span class="badge bg-success text-black fw-bold">
                        </span></li>
                <li class="text-muted"><i class="fa fa-caret-right" aria-hidden="true"></i> <span
                    class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                    </span></li>
              </ul>
            </div>
          </div>
          <input type="hidden" value="{{ $i = 1 }}">
          <div class="row my-2 mx-1 justify-content-center">
            <table class="table table-striped table-borderless">
              <thead style="background-color:#84B0CA ;" class="text-white">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Description</th>
                  <th scope="col">Category</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Unit Price</th>
                  <th scope="col">Amount</th>
                </tr>
              </thead>
              <tbody>
                @foreach( $items as $item)
                @if($item->cartQuantity != 0)
                <tr>
                  <th scope="row">{{ $i++ }}</th>
                  <td>{{ $item->productName." ".$item->item_name }}</td>
                  <td>{{ $item->categoryName }}</td>
                  <td>{{ $item->cartQuantity }}</td>
                  <td>{{ $item->price }}</td>
                  <td>{{ $sub = $item->price*$item->cartQuantity }}</td>
                </tr>
                <input type="hidden" value="{{ $total += $sub }}">
                @endif
                @endforeach
              </tbody>

            </table>
          </div>
          <div class="row">
            <div class="col-xl-8">
              <p class="ms-3">Add additional notes and payment information</p>

            </div>
            <div class="col-xl-3">
              <ul class="list-unstyled">
                <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>{{ $total }}</li>
                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Shipping({{ $cartCount }})</span>{{ $shipping }}</li>
              </ul>
              <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                  style="font-size: 25px;">{{ $totalAmount = $total + $shipping }}</span></p>
                  <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-xl-10">
              <p>Thank you for your purchase</p>
            </div>
            <div class="col-xl-2">
              <input type="submit" class="btn btn-primary text-capitalize"
                style="background-color:#60bdf3 ;" value="Place Order">
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</form>
@endsection
