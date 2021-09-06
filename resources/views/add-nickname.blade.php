@extends('layouts.app')
@section('title', 'Burning cube | Přidání nicknamu')

@section('content')
    <section id="add-nick">
        <div class="container">
            <div class="form-container">
                <h1 class="title">Zadejte Minecraft nickname</h1>
                <p class="desc">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis aut architecto consectetur, quidem officia
                    obcaecati.
                </p>
                <form action="{{ route('add-nickname.update', Auth::user()->uuid) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nickname" id="nickname" placeholder="Minecraft nick"
                            value="{{ Auth::user()->nickname }}">
                        <label for="nickname">Minecraft nickname</label>
                        @error('nickname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Přidat
                    </button>
                </form>
                @if (session()->has('error'))
                    <div class="alert alert-success">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
