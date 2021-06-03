@extends('layout')

@section('content')
    <h1 class="title is-1">Košík</h1>
    @if (session('cart') != null)
        <h3 class="subtitle">Celkem: <b>{{ number_format(session('totalPrice'), 2) }} Kč</b></h3>
    @endif
    <div class="table-container">
        <table class="table is-fullwidth is-striped">
            @if (session('cart') != null)
                <thead>
                    <th>Produkt</th>
                    <th>Množství</th>
                    <th>Cena</th>
                    <th>Celkem</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($cart as $entry)
                        <tr>
                            <td>{{ $entry->product->name }}</td>
                            <td>{{ $entry->amount }}</td>
                            <td>{{ number_format($entry->product->price, 2) }} Kč</td>
                            <td>{{ number_format($entry->amount * $entry->product->price, 2) }} Kč</td>
                            <td>
                                <a href="/kosik/odstranit/{{ $entry->product->id }}" class="button is-danger is-small">
                                    <span class="icon">
                                        <i class="far fa-trash-alt"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <tr>Košík neobsahuje žádné položky.</tr>
            @endif
        </table>
    </div>
    @if (session('cart') != null)
        <div class="buttons is-right">
            <a href="/objednavka" class="button is-link">Dokončit objednávku</a>
        </div>
    @endif
@endsection