@extends('layouts.app')

@section('title', 'Burning cube')

@section('content')
    <section id="front-page">
        <div class="container">
            <div id="banner">
                <h1 class="title">Burning Cube</h1>
                <article class="desc">
                    {!! $pageText->text !!}
                </article>
            </div>
            <div id="packages">
                <h2 class="title">
                    Balíčky
                </h2>
                <div class="link-box">
                    <a href="/how-to-do-it" class="link">Jak se připojím a aktivuji balíček?</a>
                </div>
                <div class="grid-packages">
                    @foreach ($packages as $package)
                        <div class="package">
                            <div class="block">
                                <img src="{{ asset($package->image) }}" alt="Block">
                            </div>
                            <div class="subtitle">{{ $package->name }}</div>
                            <div class="price" style="background: {{ $package->color }}">{{ $package->price }}
                                Kč</div>
                            <a href="{{ url('package', $package->sanitized_name) }}" class="btn btn-primary">Zobrazit
                                více</a>
                            <article class="desc">{!! $package->comment !!}</article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
