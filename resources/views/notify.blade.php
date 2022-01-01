@extends('layouts.app')
@section('title', 'Burning cube | Děkujeme za podporu')

@section('content')
    <section id="thanks">
        <div class="container">
            <div id="banner" class="thanks">
                <h2 class="title">{{ $message }}</h2>
            </div>
        </div>
    </section>
@endsection
