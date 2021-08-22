@extends('layouts.app')
@section('title', 'Burning cube | Ověření nicku')

@section('content')
    <main>
        <section id="verify-nick">
            <div class="container">
                <div class="form-container">
                    <h1 class="title">Ověření Minecraft nicku</h1>
                    <form action="#">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nick" placeholder="Nick">
                            <label for="nick">Nick</label>
                        </div>
                        <div class="code">
                            Kód pro ověření:
                            {{ $randomString }}
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Ověřit
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
