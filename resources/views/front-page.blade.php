@extends('layouts.app')
@section('title', 'Burning cube')

@section('content')
    <main>
        <section id="front-page">
            <div class="container">
                @include('package-list')
                @include('questions')
            </div>
        </section>
    </main>
@endsection
