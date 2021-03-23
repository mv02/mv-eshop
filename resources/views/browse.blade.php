@extends('layout')

@section('content')
    <div class="notification is-success" id="cart-notification"></div>
    <h1 class="title is-1">{{ $category->name }}</h1>
    <section class="columns is-multiline is-vcentered">
        @foreach ($category->products as $product)
            <div class="column is-one-quarter">
                <div class="card">
                    <head class="card-header">
                        <p class="card-header-title">
                            {{ $product->name }}{{ $product->unit != 'ks' ? ', ' . round($product->piece) . $product->unit : '' }}
                        </p>
                    </head>
                    <div class="card-image is-flex is-justify-content-center">
                        <figure class="image is-128x128">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </figure>
                        <span class="tag is-warning is-large" style="position: absolute; top: 5px; left: 15px;">{{ number_format($product->price, 2, ',', ' ') }} Kč</span>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            {{ $product->description }}
                        </div>
                        <div class="field has-addons has-addons-centered">
                            <div class="control">
                                <input type="number" class="input" value="1" min="1">
                            </div>
                            <div class="control">
                                <button class="button is-link" onclick="addCartItem(this, {{ $product->id }})">Do košíku</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <script>
        let notificationQueue = [];

        function addCartItem(button, productID) {
            $(button).addClass('is-loading');
            let amount = $(button).closest('.control').siblings().find('.input')[0].value;
            axios.post(`/kosik/${productID}/${amount}`)
            .then(resp => {
                $('#cart-amount').html(resp.data.totalAmount).removeClass('is-hidden');

                notificationQueue.push(`<p>${amount}x <b>${resp.data.product.name}</b></p>`);
                $('#cart-notification').html(`<p class="title is-5 mb-2">Přidáno do košíku:</p>${notificationQueue.slice(-3).join('')}`);
                $('#cart-notification').fadeIn();
                setTimeout(() => {
                    notificationQueue.shift();
                    if (notificationQueue.length == 0) $('#cart-notification').fadeOut();
                }, 5000);
            })
            .catch(e => console.log(e))
            .finally(() => $(button).removeClass('is-loading'));
        }
    </script>
    <style>
        #cart-notification {
            display: none;
            position: fixed;
            bottom: 0;
            right: 0;
            margin: 1.5rem;
            min-width: 25%;
            z-index: 5;
        }
    </style>
@endsection