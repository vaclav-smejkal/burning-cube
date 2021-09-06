@extends('layouts.app')

@section('title', 'Burning Cube | ' . $package->name)

@section('content')
    <section id="package-show">
        <div class="container">
            <div class="header">
                <div class="content">
                    <h1 class="title">{{ $package->name }}</h1>
                    <p class="desc">
                        {{ $package->comment }}
                    </p>
                    <div class="price">
                        {{ $package->price }} Kč
                    </div>
                    <a href="#" class="btn btn-primary">Koupit</a>
                </div>
                <div class="image">
                    <img src="{{ asset('img/grass-block.png') }}" alt="Block">
                </div>
            </div>
            <div class="body">
                <div class="grid-list">
                    <div class="list-group">
                        <h2 class="subtitle">
                            Lorem ipsum dolor
                        </h2>
                        <ul class="plus-list">
                            <li>
                                <i class="fas fa-plus"></i>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis corrupti magnam beatae
                            </li>
                            <li>
                                <i class="fas fa-plus"></i>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, cupiditate dolor, esse soluta
                                natus
                            </li>
                            <li>
                                <i class="fas fa-plus"></i>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus maiores perferendis nihil!
                                Autem,
                                labore voluptate quibusdam facere!
                            </li>
                        </ul>
                    </div>
                    <div class="list-group">
                        <h2 class="subtitle">
                            Ronsectetur recusandae
                        </h2>
                        <ul class="plus-list">
                            <li>
                                <i class="fas fa-plus"></i>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis corrupti magnam beatae
                                provident
                                minima nobis iste officia dolor.
                            </li>
                            <li>
                                <i class="fas fa-plus"></i>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, cupiditate dolor, esse soluta
                                natus.
                            </li>
                            <li>
                                <i class="fas fa-plus"></i>
                                Numquam mollitia accusamus amet officiis asperiores quis, magnam nemo odit praesentium porro
                                nobis.
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="footer-desc">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius alias, veritatis sapiente enim officia
                    distinctio amet aut. Possimus ipsum velit, ut pariatur dignissimos id vero! Laudantium, eligendi
                    suscipit. Qui, exercitationem?
                </p>
            </div>
        </div>
    </section>
@endsection
