@extends('layouts.app')
@section('title', 'Burning cube | Kontakty')

@section('content')
    <section id="contact">
        <div class="container">
            <article>
                {!! $pageText->text !!}
            </article>
        </div>
    </section>
@endsection
