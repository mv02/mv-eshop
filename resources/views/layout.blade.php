<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>MV Shop</title>
</head>
<body>
    <nav class="navbar is-light" role="navigation" aria-label="navigation">
        <div class="navbar-brand">
            <div class="navbar-item">
                <span class="icon">
                    <i class="fas fa-barcode title is-4"></i>
                </span>
            </div>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-menu">
            <div class="navbar-start">
                <a href="/" class="navbar-item">Domů</a>
                <a href="/podminky" class="navbar-item">Obchodní podmínky</a>
                <a href="/kontakt" class="navbar-item">Kontakt</a>
            </div>
            <div class="navbar-end">
                <div class="navbar-item buttons">
                    <a href="/kosik" class="button is-dark">
                        <span class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                        <span>Košík</span>
                        <span class="badge is-bottom-left is-info {{ session()->has('totalAmount') ? '' : 'is-hidden' }}" id="cart-amount">
                            {{ session('totalAmount') }}
                        </span>
                    </a>
                    <a href="/login" class="button is-link">Přihlásit se</a>
                </div>
            </div>
        </div>
    </nav>

    @yield('header')

    <div class="columns">
        <div class="column is-one-fifth">
            <aside class="menu p-5">
                <p class="menu-label">Účet</p>
                <ul class="menu-list">
                    <li>
                        <a href="/kosik">Košík</a>
                    </li>
                    <li>
                        <a href="/ucet/objednavky">Moje objednávky</a>
                    </li>
                    <li>
                        <a href="/ucet">Osobní údaje</a>
                    </li>
                </ul>
                <p class="menu-label">Produkty</p>
                <ul class="menu-list">
                    @foreach ($categories as $category)
                        <li>
                            <a href="/nabidka/{{ $category->id }}">
                                <span class="icon">
                                    <i class="fas {{ $category->icon ? $category->icon : 'fa-shopping-cart' }}"></i>
                                </span>
                                <span>{{ $category->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
        <hr class="is-hidden-desktop">
        <div class="column p-5">
            @yield('content')
        </div>
    </div>
    <script>
        $('.navbar-burger').on('click', () => {
            $('.navbar-menu, .navbar-burger').toggleClass('is-active');
        });
    </script>
</body>
</html>