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
@endsection