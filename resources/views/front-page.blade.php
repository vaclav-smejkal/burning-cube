@extends('layouts.app')

@section('title', 'Burning cube')

@section('content')
    <section id="front-page">
        <div class="container">
            <div id="banner">
                <h1 class="title">Burning Cube</h1>
                <p class="desc">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod nihil cumque ab odit voluptas doloribus
                    ipsa, suscipit, error magni nemo officia cupiditate nostrum facere asperiores hic, temporibus
                    perspiciatis! Vitae, quidem.
                </p>
            </div>
            <div id="packages">
                <h2 class="title">
                    Balíčky
                </h2>
                <div class="grid-packages">
                    @foreach ($packages as $package)
                        <div class="package">
                            <div class="block">
                                <img src="{{ asset('img/grass-block.png') }}" alt="Block">
                            </div>
                            <div class="subtitle">{{ $package->name }}</div>
                            <div class="price">{{ $package->price }} Kč</div>
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
