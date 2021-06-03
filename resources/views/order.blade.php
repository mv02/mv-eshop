@extends('layout')

@section('content')
    <h1 class="title">Objednávka</h1>
    <h3 class="subtitle">Celkem k úhradě: {{ number_format(session('totalPrice'), 2) }} Kč</h3>
    <div class="content">
        <p>{{ auth()->user()->given_name }} {{ auth()->user()->family_name }}</p>
        <p>{{ auth()->user()->street }} {{ auth()->user()->house_number }}</p>
        <p>{{ auth()->user()->town }}</p>
        <p>{{ auth()->user()->postal_code }}</p>
    </div>
    <button id="pay-button" class="button is-success" onclick="fakePayment()">Zaplatit</button>

    <script>
        function fakePayment() {
            const button = document.getElementById('pay-button');
            button.classList.add('is-loading');
            setTimeout(() => {
                button.classList.remove('is-loading');
                window.location.href = '/platba';
            }, 2000);
        }
    </script>
@endsection