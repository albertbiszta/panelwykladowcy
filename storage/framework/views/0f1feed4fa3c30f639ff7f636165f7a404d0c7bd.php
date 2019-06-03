<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


  <title><?php echo e(config('app.name', 'Laravel')); ?></title>

  <!-- Scripts -->

  

  <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
  




  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">




  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Styles -->
  <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
  
  <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('css/layout/app.css')); ?>" rel="stylesheet">


</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">


        <a class="navbar-brand" href="<?php echo e(url('/panel')); ?>">

          <i class="fa fa-home fa-2x"></i>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
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


              
            </ul>
          </ul>


          




          
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <nav class="navbar navbar-light bg-light justify-content-between">
             <div class="flex-center position-ref full-height">
              <?php if(Route::has('login')): ?>

              <div class="top-right links">
                <?php if(auth()->guard()->check()): ?>
                

                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> 
                   <b>  <?php echo e(Auth::user()->name); ?>  </b><span class="caret"></span>
                 </a>





                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <?php echo e(__('Wyloguj się')); ?>

                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                  <?php echo csrf_field(); ?>
                </form>
              </div>
            </li>
            <?php else: ?>
            <a href="<?php echo e(route('login')); ?>">Login</a>

            <?php if(Route::has('register')): ?>
            <a href="<?php echo e(route('register')); ?>">Register</a>
            <?php endif; ?>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <main class="py-4">
    <?php echo $__env->yieldContent('content'); ?>
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

<script src="<?php echo e(asset('js/group.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/subject.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/search.js')); ?>" type="text/javascript"></script>






</body>
</html><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/layouts/app.blade.php ENDPATH**/ ?>