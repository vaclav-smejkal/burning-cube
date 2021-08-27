<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                        <div class="name">{{ Auth::user()->nick }}</div>
                        <i class="fas fa-check-circle"></i>
                    @else
                        <a href="/verify-nick" class="name">Ověřit nick</a>
                        <i class="fas fa-times-circle"></i>
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
                        <li class="nav-item">
                            <a class="nav-link with-icon" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    @yield('content')
    <footer id="footer">
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
                    <div class="item-title">Server hosting</div>
                    <ul class="list">
                        <li class="list-item"><a href="#">Hytale Server Hosting</a></li>
                        <li class="list-item"><a href="#">Hytale Server Hosting</a></li>
                        <li class="list-item"><a href="#">Hytale Server Hosting</a></li>
                        <li class="list-item"><a href="#">Hytale Server Hosting</a></li>
                    </ul>
                </div>
                <div class="grid-item">
                    <div class="item-title">Company</div>
                    <ul class="list">
                        <li class="list-item"><a href="#">About Us</a></li>
                        <li class="list-item"><a href="#">Contact Us</a></li>
                        <li class="list-item"><a href="#">Terms of Service</a></li>
                        <li class="list-item"><a href="#">Privacy Policy</a></li>
                        <li class="list-item"><a href="#">Partners</a></li>
                        <li class="list-item"><a href="#">Earn Money</a></li>
                        <li class="list-item"><a href="#">Jobs</a></li>
                        <li class="list-item"><a href="#">SUPPORT</a></li>

                    </ul>
                </div>
                <div class="grid-item">
                    <div class="item-title">Support</div>
                    <ul class="list">
                        <li class="list-item"><a href="#">Submit a Ticket</a></li>
                        <li class="list-item"><a href="#">Knowledgebase</a></li>
                        <li class="list-item"><a href="#">Server Status</a></li>
                        <li class="list-item"><a href="#">Support Center</a></li>
                        <li class="list-item"><a href="#">LATEST TWEET</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            2021 © Burning cube
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="{{ asset('js/app.js') }}" rel="stylesheet">
</body>

</html>
