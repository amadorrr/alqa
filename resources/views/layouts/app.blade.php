<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/tw.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="overflow-hidden">
    <div id="app">
        <!-- <nav class="bg-white navbar navbar-expand-md navbar-light shadow-sm"> -->
        <!--     <div class="container"> -->
        <!--         <a class="navbar-brand" href="{{ url('home') }}"> -->
        <!--             {{ config('app.name', 'Laravel') }} -->
        <!--         </a> -->
        <!--         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"> -->
        <!--             <span class="navbar-toggler-icon"></span> -->
        <!--         </button> -->

        <!--         <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
        <!--             <!-1- Left Side Of Navbar -1-> -->
        <!--             <ul class="mr-auto navbar-nav"> -->
        <!--                 <li class="nav-item"> -->
        <!--                     <a class="nav-link" href="{{ url('gallery') }}">Gallery</a> -->
        <!--                 </li> -->
        <!--                 <li class="nav-item"> -->
        <!--                     <a class="nav-link" href="{{ url('artwork') }}">Artwork</a> -->
        <!--                 </li> -->
        <!--             </ul> -->

        <!--             <!-1- Right Side Of Navbar -1-> -->
        <!--             <ul class="ml-auto navbar-nav"> -->
        <!--                 <!-1- Authentication Links -1-> -->
        <!--                 @guest -->
        <!--                     <li class="nav-item"> -->
        <!--                         <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
        <!--                     </li> -->
        <!--                     @if (Route::has('register')) -->
        <!--                         <li class="nav-item"> -->
        <!--                             <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->
        <!--                         </li> -->
        <!--                     @endif -->
        <!--                 @else -->
        <!--                     <li class="nav-item dropdown"> -->
        <!--                         <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> -->
        <!--                             {{ Auth::user()->name }} <span class="caret"></span> -->
        <!--                         </a> -->

        <!--                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> -->
        <!--                             <a class="dropdown-item" href="{{ route('logout') }}" -->
        <!--                                onclick="event.preventDefault(); -->
        <!--                                              document.getElementById('logout-form').submit();"> -->
        <!--                                 {{ __('Logout') }} -->
        <!--                             </a> -->

        <!--                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> -->
        <!--                                 @csrf -->
        <!--                             </form> -->
        <!--                         </div> -->
        <!--                     </li> -->
        <!--                 @endguest -->
        <!--             </ul> -->
        <!--         </div> -->
        <!--     </div> -->
        <!-- </nav> -->

        <main>
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
