@extends('master')
@section('title', 'Home')
@section('main-content')
@if($message = Session::get('adminerror'))
<div class="alert alert-danger">
    {{ $message }}
</div>
@endif
{{-- item card --}}
<div class="d-flex align-items-center justify-content-center">
@foreach ($items as $item)
<div class="card container align-middle" style="width: 18rem;">
    <a href="{{ url('viewItem/'.$item->id) }}"><img class="card-img-top" src="{{ $item->image }}" alt="Card image cap" width="150px" height="180px">
    <div class="card-body align-middle" style="text-decoration:none;color:black">
      <h5 class="card-title">{{ $item->item_name }}</h5>
      <p class="card-text">{{ $item->description }}</p>
    </div></a>
    <ul class="list-group list-group-flush">
      <li class="list-group-item align-middle">&#8377. <b>{{ $item->price }}</b>/-</li>
    </ul>
    <div class="" style="padding:10px;">
      <a href="#" class="card-link btn btn-primary">Buy Now</a>
      <a href="#" class="card-link btn btn-warning">Add Cart</a>
    </div>
  </div>
  @endforeach
</div>
@endsection
