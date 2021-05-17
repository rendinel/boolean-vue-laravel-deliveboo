<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HOMEPAGE</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter&family=Acme:wght@400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>

            <header>

                <nav class="scroll">

                    <div class="container-1200 flex-between nav-content-container">

                        <a href="{{ url('/') }}">
                            <img style="height:60px;margin-top:10px;"
                                src="../../img/pink-logo.png"
                                class="hide"
                                id="pink-logo"
                            >
                        </a>

                        <div class="user-info-group">

                            @if (Route::has('login'))

                                <div class="login-links">
                                    @auth
                                        <a href="{{ url('/admin/restaurants') }}" class="your-page white-font">La tua pagina</a>
                                    @else
                                        <a href="{{ route('login') }}" class="your-page white-font">Login</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="your-page white-font">Register</a>
                                        @endif
                                    @endauth
                                </div>

                            @endif

                        </div>

                    </div>

                </nav>

            </header>
            <div id={{$idJs}}>

                @yield('main-content')

            </div>

            <footer class="deliveboo-footer">

                <div class="container-1200 footer-content">

                    <div class="footer-logo-info">
                        <img src="img/white-logo.png" class="footer-logo">
                        <ul>
                            <li>Termini e Condizioni</li>
                            <li>Privacy Policy</li>
                            <li>Cookie Policy</li>
                        </ul>
                    </div>

                    <div class="">
                        <ul>
                            <li class="footer-list-title">dove posso ordinare?</li>
                            <li>Consegna a domicilio Milano</li>
                        </ul>
                    </div>

                    <div class="">
                        <ul>
                            <li class="footer-list-title">opportunità</li>
                            <li>Diventa un ristorante Deliveboo</li>
                            <li>Diventa un rider Deliveboo</li>
                            <li>Lavora con Deliveboo</li>
                        </ul>
                    </div>

                    <div class="">

                        <div class="footer-icons">
                            <i class="fab fa-instagram"></i>
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-twitter"></i>
                            <i class="fab fa-linkedin"></i>
                            <i class="fab fa-whatsapp"></i>
                        </div>

                        <ul>
                            <li>Deliveboo S.r.l</li>
                            <li>Corso Buenos Aires, 4</li>
                            <li>20124 Milano</li>
                        </ul>

                    </div>

                </div>

            </footer>



        <script src="{{asset('js/app.js')}}"></script>

        @yield('payments-script')

    </body>
</html>
