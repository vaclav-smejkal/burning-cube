<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
</head>

<body>
    <nav id="navbar" class="navbar fixed-top navbar-expand-lg navbar-dark">
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
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
        @if (Auth::check())
            @if (!Auth::user()->hasRole('admin') || !str_contains(url()->current(), 'admin'))
                @include('faq')
            @endif
        @else
            @include('faq')
        @endif
    </main>
    <footer id="footer">
        <div class="logo-container">
            <div class="logo-grid">
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
                    <div class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo">
                    </div>
                    <div class="social">
                        <a href="#" class="link">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="link">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="link">
                            <i class="fab fa-discord"></i>
                        </a>
                        <a href="#" class="link">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="item-title">Kontakt</div>
                    <ul class="list">
                        <li class="list-item">
                            <a href="tel:+420 514 514 596">
                                <i class="fas fa-phone-alt"></i>
                                +420 514 514 596
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="mailTo:kontakt@after-life.cz">
                                <i class="fas fa-envelope"></i>
                                kontakt@after-life.cz
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="grid-item">
                    <div class="item-title">Odkazy</div>
                    <ul class="list">
                        <li class="list-item"><a href="/vop">VOP</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            {{ date('Y') }} &copy; Burning cube
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
    <link href="{{ asset('js/app.js') }}" rel="stylesheet">
</body>

</html>
