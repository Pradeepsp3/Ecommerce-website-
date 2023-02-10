@extends('master')
@section('title', 'Invoice: {{ $order->invoice_no }}')
@section('main-content')
        <div class="card border-white" >
            <div class="d-flex justify-content-center">
                <!-- <a class="btn btn-light text-capitalize text-primary border-0 btnprn" data-mdb-ripple-color="dark"><i
                        class="fa fa-print" aria-hidden="true"></i> Print</a>
                        <a class="btn btn-info me-2" data-mdb-ripple-color="dark" id="export" onclick="exportPDF()"><i
                            class="fa fa-file-pdf-o" aria-hidden="true"></i> Download Invoice</a> -->
            </div>
            <div class="card-body bg-light" id="printInvoice">
                <div class="container mb-5 mt-3">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-xl-9">
                            <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID:
                                    {{ $order->invoice_no }}</strong></p>
                            {{-- <input type="hidden" name="invoiceNo" value="#E-Com-{{ $invoiceNo }}"> --}}
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
                                    <li class="text-muted">To: <span style="color:#5d9fc5 ;">{{ $order->user_name }}</span>
                                    </li>
                                    <li class="text-muted">{{ $order->delivery_address }}</li>
                                    <li class="text-muted"><i class="fa fa-phone-square" aria-hidden="true"></i>
                                        {{ $order->contact_no }}</li>
                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <p class="text-muted">Invoice</p>
                                <ul class="list-unstyled">
                                    <li class="text-muted"><i class="fa fa-caret-right" aria-hidden="true"></i> <span
                                            class="fw-bold">ID:</span>{{ $order->invoice_no }}</li>
                                    <li class="text-muted"><i class="fa fa-caret-right" aria-hidden="true"></i> <span
                                            class="fw-bold">Creation Time: </span>{{ $order->created_at }}</li>
                                    <li class="text-muted"><i class="fa fa-caret-right" aria-hidden="true"></i> <span
                                            class="me-1 fw-bold">Payment Mode:</span><span
                                            class="badge bg-success text-white fw-bold">{{ $order->payment_mode }}
                                        </span></li>
                                    <li class="text-muted"><i class="fa fa-caret-right" aria-hidden="true"></i> <span
                                            class="me-1 fw-bold">Status:</span><span
                                            class="badge bg-warning text-black fw-bold">{{ $order->order_status }}
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
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $order->item_name }}</td>
                                        <td>{{ $order->category_name }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->item_price }}</td>
                                        <td>{{ $sub = $order->item_price * $order->quantity }}</td>
                                    </tr>
                                    {{-- <input type="hidden" value="{{ $total += $sub }}"> --}}
                                </tbody>

                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xl-8">
                                <p class="ms-3">Add additional notes and payment information</p>

                            </div>
                            <div class="col-xl-3">
                                <ul class="list-unstyled">
                                    <li class="text-muted ms-3"><span
                                            class="text-black me-4">SubTotal</span><span class="float-right">{{ $sub }}</span></li>
                                    <li class="text-muted ms-3 mt-2"><span
                                            class="text-black me-4">Shipping({{ $order->quantity }})</span><span class="float-right">{{ $shipping * $order->quantity }}</span>
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                                <li class="text-muted ms-3 mt-2"><span
                                    class="text-dark fs-5 fw-bold me-4"> Total Amount</span><span class="float-right fs-5 fw-bolder text-dark">{{ $totalAmount = $sub + $shipping }}</span></li>
                                {{-- <input type="hidden" name="totalAmount" value="{{ $totalAmount }}"> --}}
                            </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-4 d-flex justify-content-around">

                            </div>
                            <div class="col-xl-4 d-flex justify-content-center">
                                <p>Thank you for your purchase</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex">
                <div class = "col-md-6"></div>
                <div class="col-xl-6 d-flex justify-content-center">
                    <button class="btn btn-info me-2" data-mdb-ripple-color="dark" id="export" onclick='exportPDF("{{ $order->invoice_no }}")'><i
                        class="fa fa-file-pdf-o" aria-hidden="true"></i> Download Invoice</button>
                </div>
            </div>
            <div class="col-md-12" style="height:10px;">
                <div class="col-md-6"></div>
                <div class="col-md-6"></div>
            </div>
        </div>

@endsection

@push('scripts')

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.0/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rasterizehtml/1.3.0/rasterizeHTML.allinone.js"></script> --}}
<script>
// var invoiceNo = JSON.parse("{!! json_encode($order->invoice_no) !!}");
// document.getElementById("export").addEventListener("click", exportPDF());

// function exportPDF(){
//     var options = {
//   };
//   var pdf = new jsPDF('l', 'pt', 'a5');
//   pdf.addHTML($("#printInvoice"), 15, 15, options, function() {
//     pdf.save(`Invoice.pdf`);
//   });
// }

</script>

@endpush

