@extends('layouts.app')
@section('title', 'After-Life | Administrace')

@section('content')
    <section id="admin-dashboard">
        <div class="container">
            <h1 class="title">Nástěnka</h1>
            <div class="grid-items">
                <div class="item">
                    <div class="subtitle">Balíčky</div>
                    <p class="desc">
                        Možnost editace balíčků - název, cena, popis, ...
                    </p>
                    <a href="/admin/package" class="btn btn-primary">Editovat</a>
                </div>
                <div class="item">
                    <div class="subtitle">Servery</div>
                    <p class="desc">
                        Možnost editace serverů - název, IP adresa, port, ...
                    </p>
                    <a href="/admin/server" class="btn btn-primary">Editovat</a>
                </div>
                {{-- <div class="item">
                    <div class="subtitle">FAQ</div>
                    <p class="desc">
                        Možnost editace balíčků - název, cena, popis, náhledový obrázek, ...
                    </p>
                    <a href="/admin/question" class="btn btn-primary">Editovat</a>
                </div> --}}
                <div class="item">
                    <div class="subtitle">Uživatelé</div>
                    <p class="desc">
                        Možnost editace uživatelů - nickname, e-mail, ...
                    </p>
                    <a href="/admin/user" class="btn btn-primary">Editovat</a>
                </div>
                <div class="item">
                    <div class="subtitle">Stránka</div>
                    <p class="desc">
                        Možnost změny textů určitých částí webu
                    </p>
                    <a href="/admin/page-texts" class="btn btn-primary">Editovat</a>
                </div>
            </div>
        </div>
    </section>
@endsection
