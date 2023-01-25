@extends('master')
@section('title', 'Admin Panel')
@section('main-content')
@if ($message = Session::get('categoryadd'))
    <div class="alert alert-success">
        {{ $message }}
        </div>
@endif
@if ($message = Session::get('productadd'))
    <div class="alert alert-success">
        {{ $message }}
        </div>
@endif
@if ($message = Session::get('itemadd'))
    <div class="alert alert-success">
        {{ $message }}
        </div>
@endif
    {{-- <div>
        @if (Auth::check())
            @if (auth()->user()->role_as == '1')
                <div class="text-center">
                    <a href="{{ url('admin/addCategories') }}" class="btn btn-success">Add Category</a>
                    <a href="{{ url('admin/addProducts') }}" class="btn btn-success">Add Product</a>
                    <a href="{{ url('admin/addItems') }}" class="btn btn-success">Add Items</a>
                </div>
                <br>
                <div class="text-center">
                    <a href="{{ url('admin/viewCategories') }}" class="btn btn-success">view Category</a>
                    <a href="{{ url('admin/viewProducts') }}" class="btn btn-success">view Product</a>
                    <a href="{{ url('admin/viewItems') }}" class="btn btn-success">view Items</a>
                </div>
            @endif
        @endif
    </div> --}}
@endsection
