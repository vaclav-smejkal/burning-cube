@extends('layouts.app')
@section('title', 'After-Life | ' . $title)

@section('content')
    <section id="about">
        <div class="container">
            <div class="flex-group">
                <article>
                    {!! $pageText->text !!}
                    <div class="flex-items">
                        <div class="item">
                            <div class="item-title">Fakturační údaje</div>
                            <ul class="list">
                                <li class="list-item">
                                    Roman Navrátil | IČ: 09693122
                                </li>
                                <li class="list-item">
                                    Náměšť na Hané Hrad 2, 783 44
                                </li>
                            </ul>
                        </div>
                        <div class="item">
                            <div class="item-title">Kontaktní údaje</div>
                            <ul class="list">
                                <li class="list-item">
                                    <span>E-mail:</span>
                                    <a href="mainTo:kontakt@after-life.cz">kontakt@after-life.cz</a>
                                </li>
                                <li class="list-item">
                                    <span>Tel.:</span>
                                    <a href="tel:588288413">+420 588 288 413</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>
                <div class="img">
                    <img src="{{ asset('img/about.png') }}" alt="After-Life">
                </div>
            </div>
        </div>
    </section>
@endsection
