@extends('layouts.app')
@section('title', 'Burning cube | Ověření nicku')

@section('content')
    <section id="verify-nick">
        <div class="container">
            <div class="form-container">
                <h1 class="title">Ověření Minecraft nicku</h1>
                <p class="desc">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis aut architecto consectetur, quidem officia
                    obcaecati.
                </p>
                <form action="{{ route('verify-nick.update', Auth::user()->uuid) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nick" value="{{ Auth::user()->nick }}" id="nick"
                            placeholder="Nick">
                        <label for="nick">Minecraft nick</label>
                        @error('nick')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="code">
                        Kód pro ověření:
                        {{ $verifyToken }}
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Ověřit
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
