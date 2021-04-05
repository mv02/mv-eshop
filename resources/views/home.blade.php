@extends('layout')

@section('header')
    <section class="hero is-medium has-text-centered" id="title-hero">
        <div class="hero-body">
            <div class="columns is-vcentered">
                <div class="column is-one-third">
                    <div class="notification is-dark">
                        <h1 class="title is-1 has-text-light">Mňam<span class="has-text-warning">.cz</span></h1>
                    </div>
                </div>
                <div class="column is-one-fifth is-hidden-touch"></div>
                <div class="column is-hidden-touch">
                    <div class="buttons is-right">
                        @foreach ($categories->where('featured', true) as $category)
                            <a href="/nabidka/{{ $category->id }}" class="button is-rounded is-warning">
                                @if ($category->icon)
                                    <span class="icon"><i class="fas {{ $category->icon }}"></i></span>
                                @endif
                                <span>{{ $category->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        #title-hero {
            /* background-image: linear-gradient(50deg, rgb(90, 48, 230), rgb(48, 112, 230)); */
            background-image: linear-gradient(50deg, rgb(224, 143, 43), rgb(230, 166, 48));
            background-image: url('{{ asset('images/bg-blur.jpg') }}');
            background-position: center center;
        }
    </style>
@endsection

@section('content')
    <div class="content has-text-centered">
        <h1>Speciální nabídky</h1>
    </div>
@endsection