@extends('layouts.app')

@section('title', 'After-Life | Registrovat se')

@section('content')
    <section id="register">
        <div class="container">
            <div class="form-container">
                <h1 class="title">Registrovat se</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-floating">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                            value="{{ old('email') }}" placeholder="E-mail">
                        <label for="email">E-mail<span>*</span></label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            id="password" placeholder="Heslo">
                        <label for="password">Heslo<span>*</span></label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password-confirm" name="password_confirmation" placeholder="Heslo">
                        <label for="password-confirm">Heslo znovu<span>*</span></label>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="forget-link">
                        <a href="{{ url('forgot-password') }}" class="link">Zapomenuté heslo</a>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Registrovat se
                    </button>
                    <a href="/login" class="btn btn-secondary">
                        Již účet mám
                    </a>
                    <div class="membership">
                        <a class="link" href="/#early-access">Informace o členství</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
