@extends('layout')

@section('content')
    <div class="content">
        <div class="columns is-centered">
            <div class="column is-one-third has-text-centered">
                <h1>Přihlásit se</h1>
                <div class="field">
                    <a href="/login/google" class="button is-danger is-fullwidth">Přihlásit se přes Google</a>
                </div>
                <div class="field">
                    <a href="/login/fb" class="button is-link is-fullwidth">Přihlásit se přes Facebook</a>
                </div>
            </div>
        </div>
    </div>
@endsection