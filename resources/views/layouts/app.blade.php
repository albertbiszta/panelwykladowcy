<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="{{ asset('js/parsley.min.js') }}"></script>

  <script src="{{ asset('js/app.js') }}" defer></script>




  




  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">


</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">


        <a class="navbar-brand" href="{{ url('/panel') }}">

          <i class="fa fa-home fa-2x"></i>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->


          <ul class="navbar-nav mr-auto">
           <ul class="nav nav-tabs">






             <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <b>Przedmioty </b> <i class="fas fa-sort-down"></i> </a>


                <div class="dropdown-menu">
                  <a class="dropdown-item" href="/subjects">Lista przedmiotów</a>
                  <a class="dropdown-item" href="/subjects/create">Dodaj przedmiot</a>  

                </div>


              </li>


              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> 
                 <b>
                 Grupy i Studenci </b>  <i class="fas fa-sort-down"></i> </a>


                 <div class="dropdown-menu">
                  <a class="dropdown-item" href="/groups">Lista grup</a>
                  <a class="dropdown-item" href="/groups/create">Dodaj grupę</a>  
                  <div class="dropdown-divider">  </div>
                  <a class="dropdown-item" href="/students">Studenci</a>



                </div>


              </li>


             <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <b>Syllabusy </b> <i class="fas fa-sort-down"></i> </a>


                <div class="dropdown-menu">
      
                  <a class="dropdown-item" href="/syllabuses/create">Dodaj syllabus</a>  

                </div>


              </li>

{{-- 
              <li class="nav-item ">
                <a class="nav-link" href="/users"> <b>Współpracownicy </b></a>
              </li>


              @if(Auth::user()->admin == 1)


              <li class="nav-item ">
                <a class="nav-link" href="/admin">Admin</a>
              </li>

              @else
              <li class="nav-item ">
                <a class="nav-link disable" href="#" aria-disabled="true">Admin</a>
              </li>

              @endif --}}
              
            </ul>
          </ul>


          {{--  --}}




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
               <b>  {{ Auth::user()->firstname }}   {{ Auth::user()->lastname }}  </b><span class="caret"></span>
             </a>





             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Wyloguj się') }}
            </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

<script src="{{ asset('js/dynamics.js') }}" type="text/javascript" ></script>
<script src="{{ asset('js/validate.js') }}" defer></script>


<script>
  window.ParsleyConfig = {
    errorsWrapper: '<div></div>',
    errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
    errorClass: 'has-error',
    successClass: 'has-success'
  };
</script>


</body>
</html>