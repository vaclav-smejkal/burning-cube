<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
</head>

<body>
    {{-- <nav id="navbar" class="navbar fixed-top navbar-expand-lg navbar-dark">
        <div class="container">
            <div class="navbar-brand">
                <a href="/" class="logo">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo">
                </a>
                @auth
                    @if (Auth::user()->verified)
                        <div class="name">{{ Auth::user()->nickname }}</div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    @else
                        @if (Auth::user()->nickname)
                            <a href="/verify-nickname" class="name">Ověřit nickname</a>
                            <div class="icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        @else
                            <a href="/add-nickname" class="name">Přidat nickname</a>
                            <div class="icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        @endif
                    @endif
                @endauth
            </div>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav right">
                    @auth
                        @role('admin')
                            <li class="nav-item">
                                <a href="/admin" class="nav-link">Administrace</a>
                            </li>
                        @endrole
                        <li class="nav-item">
                            <a class="nav-link with-icon" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Odhlásit se
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/login">
                                Přihlášení
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">
                                Registrace
                            </a>
                        </li>
                    @endguest
                    <button class="btn btn-primary">Koupit Early Access</button>
                </ul>
            </div>
        </div>
    </nav> --}}
    <nav id="navbar">
        <div class="container">
            <span aria-hidden="true" id="dark-overlay"></span>
            <a href="#" class="brand">
                <img src="{{ asset('img/logo.svg') }}" alt="Icon" />
            </a>
            <div class="menu-wrapper">
                <ul class="menu">
                    <li>
                        <a href="/#packages">
                            Balíčky
                        </a>
                    </li>
                    <li>
                        <a href="/#early-access">
                            Early Access
                        </a>
                    </li>
                    <li>
                        <a href="/kontakt">
                            Kontakt
                        </a>
                    </li>
                    <li>
                        <a href="/o-nas">
                            O nás
                        </a>
                    </li>
                    @role('admin')
                        <li>
                            <a href="/admin">Administrace</a>
                        </li>
                    @endrole
                    @auth
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Odhlásit se
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    @endauth
                    <li class="icons">
                        <a href="/#" class="icon">
                            <img src="{{ asset('img/icons/facebook.svg') }}" alt="Facebook">
                        </a>
                        <a href="/#" class="icon">
                            <img src="{{ asset('img/icons/discord.svg') }}" alt="Discord">
                        </a>
                    </li>
                </ul>
            </div>
            <a href="/#early-access" class="btn btn-primary">Koupit Early Access</a>
            <div class="hamburger">
                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 200 200">
                    <g stroke-width="6.5" stroke-linecap="round">
                        <path d="M72 82.286h28.75" fill="#009100" fill-rule="evenodd" stroke="#848e8b" />
                        <path
                            d="M100.75 103.714l72.482-.143c.043 39.398-32.284 71.434-72.16 71.434-39.878 0-72.204-32.036-72.204-71.554"
                            fill="none" stroke="#848e8b" />
                        <path d="M72 125.143h28.75" fill="#009100" fill-rule="evenodd" stroke="#848e8b" />
                        <path
                            d="M100.75 103.714l-71.908-.143c.026-39.638 32.352-71.674 72.23-71.674 39.876 0 72.203 32.036 72.203 71.554"
                            fill="none" stroke="#848e8b" />
                        <path d="M100.75 82.286h28.75" fill="#009100" fill-rule="evenodd" stroke="#848e8b" />
                        <path d="M100.75 125.143h28.75" fill="#009100" fill-rule="evenodd" stroke="#848e8b" />
                    </g>
                </svg>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer id="footer">
        <div class="logo-container">
            <div class="logo-grid container">
                <div class="logo">
                    <img src="{{ asset('/img/gopay/gopay.png') }}" alt="Gopay">
                </div>
                <div class="logo">
                    <img src="{{ asset('/img/gopay/verified-by-visa.png') }}" alt="Verified by VISA">
                </div>
                <div class="logo">
                    <img src="{{ asset('/img/gopay/mastercard-secure-code.png') }}" alt="MasterCard Secure Code">
                </div>
                <div class="logo">
                    <img src="{{ asset('/img/gopay/visa.png') }}" alt="VISA">
                </div>
                <div class="logo">
                    <img src="{{ asset('/img/gopay/visa-electron.png') }}" alt="VISA Electron">
                </div>
                <div class="logo">
                    <img src="{{ asset('/img/gopay/mastercard.png') }}" alt="MasterCard">
                </div>
                <div class="logo">
                    <img src="{{ asset('/img/gopay/mastercard-electron.png') }}" alt="MasterCard Electronic">
                </div>
                <div class="logo">
                    <img src="{{ asset('/img/gopay/maestro.png') }}" alt="Maestro">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer-grid">
                <div class="grid-item flex-group">
                    <div class="logo-box">
                        <img src="{{ asset('img/logo.svg') }}" alt="Logo">
                    </div>
                </div>
                <div class="grid-item">
                    <div class="item-title">Fakturační údaje</div>
                    <ul class="list">
                        <li class="list-item">
                            Roman Navrátil
                        </li>
                        <li class="list-item">
                            Náměšť na Hané Hrad 2, 783 44
                        </li>
                        <li class="list-item">
                            IČ: 09693122
                        </li>
                    </ul>
                </div>
                <div class="grid-item">
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
                <div class="grid-item">
                    <li class="icons desktop">
                        <a href="/#" class="icon">
                            <img src="{{ asset('img/icons/facebook.svg') }}" alt="Facebook">
                        </a>
                        <a href="/#" class="icon">
                            <img src="{{ asset('img/icons/discord.svg') }}" alt="Discord">
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <span>{{ date('Y') }} &copy; After-Life</span>
                <div class="link-group">
                    <a href="#">Podmínky užití</a>
                    <a href="#">Obchodní informace</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        let quill = document.querySelector("#editor");
        if (quill) {
            quill = new Quill("#editor", {
                theme: "snow",
            });

            window.addEventListener('load', function(delta, oldDelta, source) {
                document.getElementById("editor-input").value = quill.root.innerHTML;
            });

            quill.on('text-change', function(delta, oldDelta, source) {
                document.getElementById("editor-input").value = quill.root.innerHTML;
            });
        }
    </script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
