@extends('layouts.app')

@section('title', 'Burning cube | Zapomenuté heslo')

@section('content')
    <main>
        <section id="reset-password">
            <div class="container">
                <div class="form-container">
                    <h1 class="title">Resetování hesla</h1>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->token }}">
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
                                name="password" value="{{ old('password') }}" placeholder="Heslo" id="password">
                            <label for="password">Heslo</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password-confirm') is-invalid @enderror"
                                name="password_confirmation" value="{{ old('password-confirm') }}"
                                placeholder="Heslo znovu" id="password-confirm">
                            <label for="password-confirm">Heslo znovu</label>
                            @error('password-confirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">
                                Resetovat heslo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
