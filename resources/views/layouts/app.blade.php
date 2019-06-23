<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->

  

  




  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">




  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('css/layout/app.css') }}" rel="stylesheet">

  <link href="{{ asset('css/mobile.css') }}" rel="stylesheet">


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






            <li class="nav-item ">
              <a class="nav-link" href="/subjects"> <b>Przedmioty </b></a>
            </li>

            


            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> 
               <b>
               Grupy i Studenci </b>  <i class="fas fa-sort-down"></i> </a>


               <div class="dropdown-menu">
                <a class="dropdown-item" href="/groups">Lista grup / Dodaj grupy</a>

                <div class="dropdown-divider">  </div>
                <a class="dropdown-item" href="/students">Wyszukaj studenta</a>



              </div>


            </li>



            <li class="nav-item ">
              <a class="nav-link" href="/lessons"> <b> Zajęcia </b></a>
            </li>



            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <b>Syllabusy </b> <i class="fas fa-sort-down"></i> </a>


                <div class="dropdown-menu">

                  <a class="dropdown-item" href="/syllabuses/create">Dodaj syllabus</a>  

                </div>


              </li>

            

            <li class="nav-item ">
              <a class="nav-link" href="/materials"> <b> Materiały dla studentów </b></a>
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
            <nav class="navbar navbar-light bg-light justify-content-between">
             <div class="flex-center position-ref full-height">
              @if (Route::has('login'))

              <div class="top-right links">
                @auth
                {{--    <a href="{{ url('/') }}">Home</a> --}}

                <li class="nav-item dropdown">
                  <a id="nav-link" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> 
                   <b>  {{ Auth::user()->firstName }}  {{ Auth::user()->lastName }} </b><span class="caret"></span>
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
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
          </div>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <main class="py-4">
    @yield('content')
  </main>
</div>




<!-- Footer -->

<footer class="app-footer">





  <!-- Footer Elements -->


  <!-- Copyright -->
  <div class="text-muted">

    <div class="footer-copyright text-center py-3" id="copyright-text"> PanelWykladowcy © 2019 

    </div>
    
    <!-- Copyright -->
  </div>
</footer>
<!-- Footer --> 




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>



<script src="{{ asset('js/attendances.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/grade.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/group.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/lesson.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/search.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/student.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/subject.js') }}" type="text/javascript"></script>



<script src="{{ asset('js/app.js') }}" defer></script>









</body>
</html>