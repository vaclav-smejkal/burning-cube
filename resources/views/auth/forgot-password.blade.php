@extends('layouts.app')

@section('title', 'Burning cube | Zapomenuté heslo')

@section('content')
    <main>
        <section id="forgot-password">
            <div class="container">
                <div class="form-container">
                    <h1 class="title">Zapomenuté heslo</h1>
                    <form method="POST" action="{{ route('password.email') }}">
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
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">
                                Poslat e-mail
                            </button>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
