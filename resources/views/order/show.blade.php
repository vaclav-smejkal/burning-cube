@extends('layouts.app')

@section('title', 'Burning Cube | Objednávka')

@section('content')
    <section id="order-show">
        <div class="container">
            <h1 class="title">Objednávka</h1>
            <div class="flex-group">
                <div class="order-info">
                    <h2 class="subtitle">Informace o nákupu</h2>
                    <ul class="info-list">
                        <li>Název: {{ $package->name }}</li>
                        <li>Cena: {{ $package->price }} Kč</li>
                    </ul>
                    <article>
                        {!! $package->comment !!}
                    </article>
                </div>
                <form class="order-form" action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <h2 class="subtitle">Formulář</h2>
                    @guest
                        <p class="desc">
                            Prosím <a href="/login">přihlaste se</a> nebo zaregistrujte:
                        </p>
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname"
                                id="nickname" value="{{ old('nickname') }}" placeholder="Nickname">
                            <label for="nickname">Nickname</label>
                        </div>
                        @error('nickname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                value="{{ old('email') }}" placeholder="E-mail">
                            <label for="email">E-mail</label>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                id="password" placeholder="Heslo">
                            <label for="password">Heslo</label>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password-confirm" name="password_confirmation" placeholder="Heslo">
                            <label for="password-confirm">Heslo znovu</label>
                        </div>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    @endguest
                    @auth
                        @if (!Auth::user()->nickname)
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname"
                                    id="nickname" value="{{ old('nickname') }}" placeholder="Nickname">
                                <label for="nickname">Nickname</label>
                            </div>
                            @error('nickname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        @endif
                    @endauth
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Poznámka" name="comment" id="comment"
                            value="{{ old('comment') }}"></textarea>
                        <label for="comment">Poznámka</label>
                    </div>
                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <h2 class="subtitle">Fakturační údaje</h2>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name_surname" id="name_surname"
                            placeholder="Jméno a příjmení" value="{{ old('name_surname') }}">
                        <label for="name_surname">Jméno a příjmení</label>
                    </div>
                    @error('name_surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <input type="text" class="form-control" name="place" id="place" placeholder="Bydliště"
                            value="{{ old('place') }}">
                        <label for="place">Bydliště</label>
                    </div>
                    @error('place')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <input type="text" class="form-control" name="psc" id="psc" placeholder="PSČ"
                            value="{{ old('psc') }}">
                        <label for="psc">PSČ</label>
                    </div>
                    @error('psc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terms" id="terms">
                        <label class="form-check-label" for="terms">
                            Souhlasím s <a href="/vop">všeobecnými obchodními podmínkami</a>
                        </label>
                    </div>
                    @error('terms')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-primary">Objednat a zaplatit</button>
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </section>
@endsection
