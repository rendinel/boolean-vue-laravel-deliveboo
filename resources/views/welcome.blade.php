{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HOMEPAGE</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">


    </head>
    <body>


        <div id="app">
            <header>

                <nav>

                    <div class="flex-center position-ref full-height">
                        @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                    <a href="{{ url('/home') }}">Home</a>
                                @else
                                    <a href="{{ route('login') }}">Login</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>

                    <div class="bottom-nav">

                    </div>

                </nav>

                <div class="jumbotron-delivery restaurant-card">

                    <div class="input-group">
                        <input v-model='userSearch'
                            v-on:keyup.enter="search()"
                            class="form-control"
                            type="search"
                            placeholder="Cerca un ristorante"
                        >
                    </div>

                    <div class="restaurant-card">

                        <prova v-for='(restaurant, index) in results'
                            :key='index'
                            :results='restaurant'
                            :categories="restaurant.categories"
                        >
                        </prova>

                    </div>

                </div>



            </header>
        </div>

        <script src="{{asset('js/app.js')}}"></script>

    </body>
</html> --}}
