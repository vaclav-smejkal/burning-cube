@extends('layouts.app')

@section('title', 'Burning cube | Přihlášení')

@section('content')
    <main>
        <section id="login">
            <div class="container">
                <div class="form-container">
                    <h1 class="title">Přihlášení</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" placeholder="E-mail">
                            <label for="email">E-mail</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" value="{{ old('password') }}" name="password" placeholder="Heslo">
                            <label for="password">Heslo</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">
                                Přihlásit
                            </button>
                            <div class="links">
                                <a href="{{ url('register') }}">Ještě nemáte účet?</a>
                                <span>|</span>
                                <a href="{{ url('forgot-password') }}">Zapomenuté heslo</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
