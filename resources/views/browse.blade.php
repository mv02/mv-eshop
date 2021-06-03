@extends('layout')

@section('content')
    <div class="notification is-success" id="cart-notification"></div>
    <h1 class="title is-1">{{ $selectedCategory->name }}</h1>
    @include('products', ['products' => $selectedCategory->products])
@endsection