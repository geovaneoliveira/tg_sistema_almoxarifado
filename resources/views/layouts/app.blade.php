<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/estilo.css"> 
    <link rel="stylesheet" type="text/css" href="/fontawesome-free-5.10.2-web/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

   @stack('scripts')


    
</head>

<body  >
    <div id="app" class="container bg-light">
        <nav class="row navbar navbar-expand navbar-light shadow-sm pl-4" >
               <!-- Right Side Of Navbar -->

            <a href="/home" class="navbar-brand " id="menu-marca">
              <span class="fab fa-envira display-4"></span>  <span>Bosque</span> </a>
                     
                    
                    <ul class="navbar-nav ml-auto " >
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"> Registrar-se</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
        </nav>

            <div class="row"  style="overflow-y: auto;" >
                <div class="col-md-3 p-0 " >
                         @yield('lateral')
                </div>  
    
                <div class="col-md-9 pt-3 align-self-start">
                    @yield('conteudo')
                </div>               
            </div>

            <div class="row">
                @yield('conteudoCentralizado') 
            </div>

            <div class="row ">
                <footer class="col-12 shadow bg-light justify-content-center">
                </footer>                
            </div>
</div>

</body>
</html>
