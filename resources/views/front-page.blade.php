@extends('layouts.app')

@section('title', 'After-Life')

@section('content')
    <section id="banner">
        <div class="container">
            <article class="desc">
                {!! nl2br($pageText->text) !!}
            </article>
            <a href="/#early-access" class="btn btn-primary btn-main">
                Koupit Early Access
                <div class="icon">
                    <img src="{{ asset('img/icons/bag.svg') }}" alt="Balíčky">
                </div>
            </a>
        </div>
        <div class="icons desktop vertical">
            <a href="/#" class="icon">
                <img src="{{ asset('img/icons/facebook.svg') }}" alt="Facebook">
            </a>
            <a href="/#" class="icon">
                <img src="{{ asset('img/icons/discord.svg') }}" alt="Discord">
            </a>
        </div>
    </section>
    <section id="packages">
        <div class="container">
            <h2 class="title">
                Připoj se na server jako první!
            </h2>
            <p class="title-desc">
                Předplať si VIP balíček za výhodnější cenu a získej předběžný přístup na server.<br>
                Nákupem <span>podpoříš vývoj a dostaneš možnost testovat server dlouho před spuštěním.</span>
            </p>
            <div class="grid-packages">
                @foreach ($packages as $index => $package)
                    <div class="package">
                        <button class="btn btn-collapse collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                            aria-controls="collapse{{ $index }}">
                            <span></span>
                            <span></span>
                        </button>
                        <div class="subtitle">{{ $package->name }}</div>
                        <div class="block">
                            <img src="{{ asset($package->image) }}" alt="Block">
                        </div>
                        <div class="price">
                            {{ $package->price }}
                            <span>Kč</span>
                        </div>
                        <span class="price-info">Měsíčně pro jednoho uživatele</span>
                        <p class="desc">
                            Přístup na server 5 dní před oficiálním spuštěním,
                            <strong>Early Access během vývoje</strong>. Unikátní tag.
                        </p>
                        <a href="/order/{{ $package->sanitized_name }}" class="btn btn-primary btn-main">
                            Koupit balíček
                        </a>
                        <div id="collapse{{ $index }}" class="collapse">
                            <article class="desc">{!! $package->comment !!}</article>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="early-access">
        <div class="container">
            <div class="grid">
                <div class="group">
                    <h2 class="title">
                        Proč si zakoupit Early Access?
                    </h2>
                    <div class="title-desc">
                        Podpořením serveru nákupem předplaceného Early Access VIP získáte unikátní výhody.
                    </div>
                </div>
                <div class="img">
                    <img src="{{ asset('img/player.png') }}" alt="Player">
                </div>
                <ol>
                    <li>
                        Veškeří hráči s předplaceným VIP balíčkem se můžou podílet na testování a mít přístup na BETA
                        servery. Zároveň si finální verzi hry zahrají už <strong>o 5 dní dříve!</strong>
                    </li>
                    <li>
                        Získají také <strong>přístup do vyhrazené místnosti na Discordu</strong> (after-life.cz/discord),
                        kde můžou komunikovat s vývojáři a ovlivnit vývoj After-Life, nebo mít všechny horké novinky.
                    </li>
                </ol>
                <a href="#packages" class="btn btn-primary btn-main">
                    Koupit Early Access
                    <div class="icon">
                        <img src="{{ asset('img/icons/bag.svg') }}" alt="Balíčky">
                    </div>
                </a>
            </div>
        </div>
    </section>
    <section id="gallery">
        <div class="container">
            <h2 class="title">Mrkněte, jak to u nás vypadá</h2>
            <div class="title-desc">
                Jedinečná příležitost se společně s námi podílet na budoucnosti tohoto světa.
            </div>
        </div>
        <div class="container">
            <div class="overflow">
                <div class="gallery-carousel">
                    <div class="carousel-cell">
                        <div class="img">
                            <img src="{{ asset('img/photo-1.png') }}" alt="Photo">
                        </div>
                    </div>
                    <div class="carousel-cell">
                        <div class="img">
                            <img src="{{ asset('img/photo-1.png') }}" alt="Photo">
                        </div>
                    </div>
                    <div class="carousel-cell">
                        <div class="img">
                            <img src="{{ asset('img/photo-1.png') }}" alt="Photo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="info">
        <div class="container">
            <div class="content">
                <h3 class="subtitle">Sledujte aktuální dění na sociálních sítích</h3>
                <div class="title-desc">
                    Doporučujeme i nadále sledovat Discord a FB stránku, abyste byly vždy v obraze s aktuální situací.
                </div>
                <li class="icons dektop">
                    <a href="/#" class="icon green">
                        <img src="{{ asset('img/icons/facebook.svg') }}" alt="Facebook">
                    </a>
                    <a href="/#" class="icon green">
                        <img src="{{ asset('img/icons/discord.svg') }}" alt="Discord">
                    </a>
                </li>
            </div>
            <div class="faq-card">
                <div class="img">
                    <img src="{{ asset('img/icons/faq.svg') }}" alt="Dotazy">
                </div>
                <div class="title">
                    Máte dotazy?
                </div>
                <div class="title-desc">
                    Neváhejte nás kontaktovat přes email <a href="mailTo:kontakt@after-life.cz">kontakt@after-life.cz</a>.
                </div>
                <p>
                    Další informace k VIP platbě, reklamace atd. můžete řešit pomocí ticket sekce na
                    <span>after-life.cz/discord</span>, případně napište na email: <a
                        href="mainTo:reklamace@after-life.cz">reklamace@after-life.cz</a>, Děkujeme!
                </p>
            </div>
        </div>
    </section>
@endsection
