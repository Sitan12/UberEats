<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script defer src="https://maps.googleapis.com/maps/api/js?libraries=places&language=fr&key=AIzaSyCLW9Bqil_qNREpsU2HUjg1-5B_IQJxsrc" type="text/javascript"></script> -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet"> 

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    @notify_css
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                        <li class="nav-item">
                            <a href="{{route('apropos')}}" class="nav-link"> A propros</a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{route('contact')}}" class="nav-link">Contactez-nous</a>
                        </li>
                        <!-- Authentication Links -->

                        @guest
                            @if(Route::has('login'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="login" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Login
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="login">
                                    <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('Login Client') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('restos.login') }}">{{ __('Login Restaurant') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('livreur.login') }}">{{ __('Login Livreur') }}</a></li>
                                </ul>
                            </li>

                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="register" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    REGISTER
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="register">
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Client</a></li>
                                    <li><a class="dropdown-item" href="{{ route('autre') }}">Restaurant</a></li>
                                    <li><a class="dropdown-item" href="{{ route('livreur.create') }}">Livreur</a></li>
                                </ul>
                            </li>
                                @endif 
                                 
                        @else
                        @if ( Auth::user()->role == "livreur" )
                                <li class="nav-item">
                                    <a class="nav-link" style="color:yellow" href="{{url('livreurCommandeClient')}}">
                                        Mes commandes
                                    </a>
                                </li>
                            @endif
                            @if ( Auth::user()->role == "restaurant" )
                                <li class="nav-item">
                                    <a class="nav-link" style="color:yellow"  href="{{url('restaurant')}}">
                                        Mes commandes
                                    </a>
                                </li>
                            @endif
                        <li class="nav-item dropdown">
                            <a  class="nav-link" href="{{ route('notification') }}" role="button">
                               Notifications 
                                    <span class="badge bg-success">
                                    {{ count($notify) }}
                                    </span>
                            </a>
                         </li>
                        @if( Auth::user()->role == "client" )
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('panier')}}"><i class="fa fa-cart-plus" aria-hidden="true"></i>
                                    {{count($com)}}
                                </a>
                            </li>
                          @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                @if( Auth::user()->role == "client" )
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                                <a class="dropdown-item" href="{{ route('profiles.show', Auth::user()->name) }}">
                                        {{ __('Mon Profile') }}
                                    </a>
                                @endif
                                   
                                    @if( Auth::user()->role == "restaurant" )
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                                <a class="dropdown-item" href="{{ route('restaurant.profile', Auth::user()->name) }}">
                                        {{ __('Mon Profile') }}
                                </a>
                                
                                    
                                    @endif
                                    @if( Auth::user()->role == "livreur" )
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                                <a class="dropdown-item" href="{{ route('livreur.profile', Auth::user()->name) }}">
                                        {{ __('Mon Profile') }}
                                    </a>
                                    @endif
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

@notify_js
@notify_render
</html>
