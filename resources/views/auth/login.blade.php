@extends('layouts.app')

@section('title', 'After-Life | Přihlásit se')

@section('content')
    <section id="login">
        <div class="container">
            <div class="form-container">
                <h1 class="title">Přihlásit se</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                            value="{{ old('email') }}" placeholder="E-mail">
                        <label for="email">E-mail<span>*</span></label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            value="{{ old('password') }}" name="password" placeholder="Heslo">
                        <label for="password">Heslo<span>*</span></label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="forget-link">
                        <a href="{{ url('forgot-password') }}" class="link">Zapomněli jste heslo?</a>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Přihlásit se
                    </button>
                    <a href="/register" class="btn btn-secondary">
                        Vytvořit účet
                    </a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="membership">
                        <a class="link" href="/#early-access">Informace o členství</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
