@extends('layouts.app')
@section('title', 'Burning cube')

@section('content')
    <main>
        <section id="front-page">
            <div class="container">
                <div>
                    Balíčky
                </div>
                @include('questions')
            </div>
        </section>
    </main>
@endsection
