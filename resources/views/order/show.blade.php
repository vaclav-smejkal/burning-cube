@extends('layouts.app')

@section('title', 'Burning Cube | Objednávka')

@section('content')
    <section id="order-show">
        <div class="container">
            <h1 class="title">Objednávka</h1>
            <div class="flex-group">
                <div class="order-info">
                    <h2 class="subtitle">Informace o nákupu</h2>
                    <ul class="info-list">
                        <li>Název: {{ $package->name }}</li>
                        <li>Cena: {{ $package->price }} Kč</li>
                    </ul>
                    <article>
                        {!! $package->comment !!}
                    </article>
                </div>
                <form class="order-form" method="POST">
                    <h2 class="subtitle">Formulář</h2>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}"
                            placeholder="E-mail">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nickname" id="nickname"
                            value="{{ Auth::user()->nickname }}" placeholder="Nickname">
                        <label for="nickname">Nickname</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Poznámka" name="comment" id="comment"></textarea>
                        <label for="comment">Poznámka</label>
                    </div>
                    <h2 class="subtitle">Fakturační údaje</h2>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Jméno a příjmení">
                        <label for="name">Jméno a příjmení</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="residence" id="residence" placeholder="Bydliště">
                        <label for="residence">Bydliště</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="psc" id="psc" placeholder="PSČ">
                        <label for="psc">PSČ</label>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
