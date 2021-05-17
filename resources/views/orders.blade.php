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
    <body class="statistic-body">


    <div class="main-background"></div>

    <div class="sticky-nav">
        <nav style="height:80px; width:100vw" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img style="height:60px" src="{{ asset('img/pink-logo.png')}}" alt="">
                     </a>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                         <span class="navbar-toggler-icon"></span>
                     </button>

                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                         <!-- Left Side Of Navbar -->
                         <ul class="navbar-nav mr-auto">

                         </ul>

                         <!-- Right Side Of Navbar -->
                         <ul class="navbar-nav ml-auto">
                             <!-- Authentication Links -->
                             @guest
                                 <li class="nav-item">
                                     <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                 </li>
                                 @if (Route::has('register'))
                                     <li class="nav-item">
                                         <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                     </li>
                                 @endif
                             @else
                                 <li class="nav-item dropdown">
                                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                         {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                                     </a>

                                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                         <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                             {{ __('Logout') }}
                                         </a>

                                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                             @csrf
                                         </form>
                                     </div>
                                 </li>
                             @endguest
                         </ul>
                     </div>
            </div>

    </nav>
    </div>

    <div  class="container social-distancing">

        <div class="plate-center padding-title">


            <h2 class="order-title">Gli ordini: {{$restaurant->business_name}}</h2>

            <div class="chart-container" style=" width:100%">
                <canvas id="userChart" ></canvas>
            </div>
            @foreach ($restaurant->orders as $order)
            <div class="statistic-container">

                <div class="statistic-card">

                    <p class="space-card-plate-container-right size-font weight"> Ordine N.: {{$order->id}}</p>
                    <p class="space-card-plate-container-right size-font"> Indirizzo Consegna: {{$order->address}}</p>
                    <p class="space-card-plate-container-right size-font"> Specifiche Ordine:
                        @foreach ($order->plates as $plate)
                        {{$plate->name}}
                        @endforeach</p>
                    <div class="space-card-plate-container-right size-font"> Totale Pagato: {{$order->total}}€</div>
                </div>


            </div>


           @endforeach

             <div class="button-container">

                    <a class="text-decoration-none" href="{{route('restaurants.index')}}">
                        <div class="utility-button-home"><span>Dashboard</span></div>
                    </a>

             </div>
        </div>
    </div>

    <footer class="deliveboo-footer">

        <div class="container footer-content">

            <div class="footer-logo-info">
                <img src="{{ asset('img/white-logo.png')}}" class="footer-logo">
                <ul>
                    <li>Termini e Condizioni</li>
                    <li>Privacy Policy</li>
                    <li>Cookie Policy</li>
                </ul>
            </div>

            <div class="footer-none">
                <ul>
                    <li class="footer-list-title">dove posso ordinare?</li>
                    <li>Consegna a domicilio Milano</li>
                    <li class="footer-list-title">opportunità</li>
                    <li>Diventa un ristorante Deliveboo</li>
                    <li>Diventa un rider Deliveboo</li>
                    <li>Lavora con Deliveboo</li>
                </ul>
            </div>

            <div class="icons-container">

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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <!-- CHARTS -->
  <script>
      var ctx = document.getElementById('userChart').getContext('2d');
      var chart = new Chart(ctx, {
          // The type of chart we want to create
          type: 'bar',
  // The data for our dataset
          data: {
              labels:  {!!json_encode($chart->labels)!!} ,
              datasets: [
                  {
                      label: '2021',
                      backgroundColor: {!! json_encode($chart->colours)!!} ,
                      data:  {!! json_encode($chart->dataset)!!} ,
                  },
              ]
          },
  // Configuration options go here
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true,
                          callback: function(value) {if (value % 1 === 0) {return value;}}
                      },
                      scaleLabel: {
                          display: false
                      }
                  }]
              },
              legend: {
                  labels: {
                      // This more specific font property overrides the global property
                      fontColor: '#122C4B',
                      fontFamily: "'Muli', sans-serif",
                      padding: 25,
                      boxWidth: 25,
                      fontSize: 14,
                  }
              },
              layout: {
                  padding: {
                      left: 10,
                      right: 10,
                      top: 0,
                      bottom: 10
                  }
              }
          }
      });
  </script>
      </body>
  </html>
