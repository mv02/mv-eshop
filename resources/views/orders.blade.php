@extends('layout')

@section('content')
    <h1 class="title is-1">Moje objednávky</h1>

    @if ($orders->count() > 0)
        @foreach ($orders as $order)
            <div class="box content">
                <h4>Objednávka {{ $order->id }}</h4>
                <h6>{{ number_format($order->totalPrice, 2) }} Kč</h6>
                <hr>
                @foreach ($order->products as $product)
                    <p>{{ $product->pivot->amount }}x <b>{{ $product->name }}</b></p>
                @endforeach
            </div>
        @endforeach
    @else
        <p>Nemáte žádné aktivní objednávky.</p>
    @endif
@endsection