@extends('layouts.app')
@section('title', 'Burning cube | Jak na to?')

@section('content')
    <section id="how-to-do-it">
        <div class="container">
            <article>
                {!! $pageText->text !!}
            </article>
        </div>
    </section>
@endsection
