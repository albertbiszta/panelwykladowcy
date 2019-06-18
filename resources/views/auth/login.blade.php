@auth
  <script>window.location = "/panel";</script>
  @else 
@extends('layouts.guest')

@section('content')

  









<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
             
               <div class="card-body"></div>

               <div class="card-body">
                <p id="p-center-big">  Zaloguj się  </p>    

            </div>

            <div class="card-body " id="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row justify-content-center">
                      {{--   <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label> --}}

                      <div class="col-md-6">
                        <input id="email" type="email" placeholder="E-Mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                 {{--    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label> --}}

                 <div class="col-md-6">
                    <input id="password" type="password" placeholder="Hasło" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Zapamiętaj mnie') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">

{{-- 
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif --}}
                                    <p id="p-center">

                                     <button type="submit" class="btn btn-outline-secondary" id="button-1">
                                        {{ __('Zaloguj się') }}
                                    </button>
                                </p>


                            </div>
                        </div>

                    </form>
                    <div class="card-body">
                        <p id="p-center">
                            Nie masz konta?

                        </p>

                        <p id="p-center">
                            <b>   
                              <a href="{{ route('register') }}">
                                {{ __('Zarejestruj się') }}
                            </a> 
                        </b>



                    </p>



                </div>

            </div>
            {{--  --}}



        </div>
    </div>
</div>
</div>


@endsection

@endif