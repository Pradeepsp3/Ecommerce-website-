@extends('master')
@section('title', 'Home')
@section('main-content')
    @if ($message = Session::get('adminerror'))
        <div class="alert alert-danger container">
            {{ $message }}
        </div>
    @endif
    @if ($message = Session::get('orderAddedError'))
        <div class="alert alert-danger container">
            {{ $message }}
        </div>
    @endif
    @if ($message = Session::get('orderAdded'))
        <div class="alert alert-success container">
            {{ $message }}
        </div>
    @endif
    {{-- item card --}}
    <div class="container d-flex justify-content-around flex-wrap">
        @foreach ($items as $item)
        @if($item->quantity > 0)
            <div class="card container align-middle mt-5" style="width: 18rem;padding:2px;">
                <a href="{{ url('viewItem/' . $item->id) }}"><img class="card-img-top" src="{{ $item->image }}"
                        alt="Card image cap" width="150px" height="180px">
                    <div class="card-body align-middle" style="text-decoration:none;color:black">
                        <h5 class="card-title">{{ $item->item_name }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                    </div>
                </a>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item align-middle">&#8377. <b id="amount">{{ $item->price }}</b>/-</li>
                </ul>

                <div class="d-flex align-items-center justify-content-center" style="padding:10px;">
                    <a href="{{ url('buynow/' . $item->id) }}" class="card-link btn btn-primary">Buy Now</a>
                    <a class="card-link btn btn-warning" href="{{ url('addToCart/' . $item->id) }}">Add Cart</a>
                    {{-- <h5 id="cartItem">{{ $item->id }}</h5> --}}
                </div>
            </div>
            @endif
        @endforeach
    </div>
    <div class="mb-5"></div>
@endsection
