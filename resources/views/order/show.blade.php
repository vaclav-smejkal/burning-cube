@extends('layouts.app')

@section('title', 'After-Life | Objednávka')

@section('content')
    <section id="order-show">
        <div class="container">
            <h1 class="title">Objednávka</h1>
            <div class="grid-group">
                <div class="package">
                    <button class="btn btn-collapse collapsed" type="button" data-card-collapse="i-0">
                        <span></span>
                        <span></span>
                    </button>
                    <div class="card-collapse mobile i-0">
                        <div class="subtitle">{{ $package->name }}</div>
                        <div class="block">
                            <img src="{{ asset($package->image) }}" alt="Block">
                        </div>
                        <p class="desc">
                            Přístup na server 5 dní před oficiálním spuštěním,
                            <strong>Early Access během vývoje</strong>. Unikátní tag.
                        </p>
                    </div>
                    <div class="card-collapse i-0">
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
                        <article class="desc">{!! $package->comment !!}</article>
                    </div>
                </div>
                <form class="order-form" action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment-uuid"
                        value="@isset($paymentUUID) {{ $paymentUUID }} @endisset">
                    <h2 class="subtitle">Formulář</h2>
                    <input type="hidden" name="package_sanitized_name" value="{{ $package->sanitized_name }}">
                    @error('package_sanitized_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @guest
                        <p class="desc">
                            Vyplňte prosím údaje nebo se <a href="/login">přihlaste</a>
                        </p>
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname"
                                id="nickname" value="{{ old('nickname') }}" placeholder="Nickname">
                            <label for="nickname">Nickname <span>*</span></label>
                        </div>
                        @error('nickname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-floating">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                value="{{ old('email') }}" placeholder="E-mail">
                            <label for="email">E-mail <span>*</span></label>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    @endguest
                    @auth
                        <div class="desc">E-mail: {{ Auth::user()->email }}</div>
                        @if (!Auth::user()->nickname)
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname"
                                    id="nickname" value="{{ old('nickname') }}" placeholder="Nickname">
                                <label for="nickname">Nickname <span>*</span></label>
                            </div>
                            @error('nickname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        @endif
                    @endauth
                    <div class="form-floating">
                        <input type="text" class="form-control @error('discord-tag') is-invalid @enderror"
                            name="discord-tag" id="discord-tag" value="{{ old('discord-tag') }}"
                            placeholder="Discord Tag">
                        <label for="discord-tag">Discord Tag</label>
                    </div>
                    @error('discord-tag')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Poznámka" name="comment" id="comment"
                            value="{{ old('comment') }}"></textarea>
                        <label for="comment">Poznámka</label>
                    </div>
                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    {{-- @error('name_surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('place')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('psc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                     <h2 class="subtitle">Fakturační údaje</h2>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name_surname" id="name_surname"
                            placeholder="Jméno a příjmení" value="{{ old('name_surname') }}">
                        <label for="name_surname">Jméno a příjmení</label>
                    </div>
                    @error('name_surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <input type="text" class="form-control" name="place" id="place" placeholder="Bydliště"
                            value="{{ old('place') }}">
                        <label for="place">Bydliště</label>
                    </div>
                    @error('place')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <input type="text" class="form-control" name="psc" id="psc" placeholder="PSČ"
                            value="{{ old('psc') }}">
                        <label for="psc">PSČ</label>
                    </div>
                    @error('psc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terms" id="terms">
                        <label class="form-check-label" for="terms">
                            Souhlasím s <a href="/vop">všeobecnými obchodními podmínkami</a>
                        </label>
                    </div>
                    @error('terms')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('payment-method')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Zvolit platební metodu</button>
                    @if (!empty($gopayMessage))
                        <div class="alert @if ($success)alert-success @else alert-danger @endif" role="alert">
                            {{ $gopayMessage }}
                            Pro opakování platby klikněte <button id="repeat-payment" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">zde</button>.
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title subtitle" id="staticBackdropLabel">Platební metody</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="method">
                                        <div class="payment">Gopay</div>
                                        <div class="desc">
                                            Platba Kartou, Převodem, Bitcoin
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="payment-method" value="gopay">
                                            Zvolit
                                        </button>
                                    </div>
                                    {{-- <div class="method">
                                        <div class="payment">PaySafeCard</div>
                                        <div class="desc">
                                            +13% poplatek za platbu
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="payment-method" value="paysafe">
                                            Zvolit
                                        </button>
                                    </div> --}}
                                    <div class="method">
                                        <div class="payment">Premium SMS</div>
                                        <div class="desc">
                                            +15% poplatek za platbu
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="payment-method" value="sms">
                                            Zvolit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
