@extends('layout')

@section('content')
    @if (session()->has('errorMessage'))
        <div id="notification" class="notification is-danger">
            <button class="delete" onclick="document.getElementById('notification').remove()"></button>
            {{ session('errorMessage') }}
        </div>
    @endif
    @if (session()->has('successMessage'))
        <div id="notification" class="notification is-success">
            <button class="delete" onclick="document.getElementById('notification').remove()"></button>
            {{ session('successMessage') }}
        </div>
    @endif
    <div class="columns is-centered">
        <div class="column is-half">
            <h1 class="title has-text-centered">Osobní údaje</h1>
            <form method="post">
                @csrf
                <div class="field">
                    <label class="label" for="givenName">Křestní jméno</label>
                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                        <input class="input" name="givenName" type="text" value="{{ auth()->user()->given_name }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="familyName">Příjmení</label>
                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                        <input class="input" name="familyName" type="text" value="{{ auth()->user()->family_name }}" required>
                    </div>
                </div>

                <hr>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Adresa</label>
                    </div>
                    <div class="field-body">
                        <div class="field has-addons">
                            <p class="control is-expanded has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-road"></i>
                                </span>
                                <input class="input" name="street" type="text" value="{{ auth()->user()->street }}" placeholder="Ulice" required>
                            </p>
                            <p class="control">
                                <input class="input" name="houseNumber" type="number" value="{{ auth()->user()->house_number }}" placeholder="Číslo" min="1" max="99999" required>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label"></div>
                    <div class="field-body">
                        <div class="field has-addons">
                            <p class="control is-expanded has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-building"></i>
                                </span>
                                <input class="input" name="town" type="text" value="{{ auth()->user()->town }}" placeholder="Město" required>
                            </p>
                            <p class="control">
                                <input class="input" name="postalCode" type="number" value="{{ auth()->user()->postal_code }}" placeholder="PSČ" min="10000" max="99999" required>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-grouped is-grouped-right">
                    <div class="control">
                        <button class="button is-link">Uložit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection