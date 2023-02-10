@extends('master')
@section('title', 'Admin Panel')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/statsDashboard.css') }}">
@endpush

@section('main-content')
    @if ($message = Session::get('categoryadd'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('productadd'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('itemadd'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('userAdded'))
        <div class="alert alert-success container">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="main-content container" style="">
        <div class="header pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <h2 class="mb-5">Stats Card</h2>
                <div class="header-body">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <a href="{{ url('admin/viewItems') }}" class="text-decoration-none">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Total Items in Stock
                                                </h5>
                                                <span class="h2 font-weight-bold mb-0">{{ $totalItemsInStock }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape rounded-circle shadow">
                                                    <i class="fa fa-industry" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-muted text-sm">
                                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>&nbsp; {{ $orders->count(); }}</span>
                                            <span class="text-nowrap">Items Sold</span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <a href="{{ url('admin/viewUsers') }}" class="text-decoration-none">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Customers</h5>
                                                <span class="h2 font-weight-bold mb-0">{{ $users->where('role_as','=',0)->count() }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape rounded-circle shadow">
                                                    <i class="fa fa-users" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-muted text-sm">
                                            <span class="text-danger mr-2"><i class="fa fa-users" aria-hidden="true"></i>&nbsp; {{ $users->count() }}</span>
                                            <span class="text-nowrap">Total Users</span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <a href="{{ url('admin/ordersInProgress') }}" class="text-decoration-none">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Orders in Progress
                                                </h5>
                                                <span class="h2 font-weight-bold mb-0">{{ $orderInProgress }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-yellow rounded-circle shadow">
                                                    <i class="fa fa-cubes" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-muted text-sm">
                                            <span class="text-info mr-2"><i class="fa fa-archive" aria-hidden="true"></i>&nbsp; {{ $deliveredOrders }}</span>
                                            <span class="text-nowrap">Total Delivered</span>
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


