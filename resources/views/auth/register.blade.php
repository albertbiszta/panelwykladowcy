@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <br>
               <div class="card-body">
                <p id="p-center-big">  Zarejestruj się  </p>    

           


                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row justify-content-center">
                        {{--     <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Imię i Nazwisko ') }}</label> --}}

                            <div class="col-md-6">
                                <input id="firstName"  placeholder="Imię" type="text" class="form-control @error('firstName') is-invalid @enderror" 
                                name="firstName" value="{{ old('name') }}" required autocomplete="firstName" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                          <div class="form-group row justify-content-center">
                        {{--     <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Imię i Nazwisko ') }}</label> --}}

                            <div class="col-md-6">
                                <input id="lastName"  placeholder="Nazwisko" type="text" class="form-control @error('lastName') is-invalid @enderror" 
                                name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row justify-content-center">
                           {{--  <label for="university" class="col-md-4 col-form-label text-md-right">{{ __('Uczelnia') }}</label> --}}

                            <div class="col-md-6">
                                <input id="university"  placeholder="Uczelnia" type="text" class="form-control @error('university') is-invalid @enderror" name="university" value="{{ old('university') }}" required autocomplete="university" autofocus>

                                @error('university')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row justify-content-center">
                          {{--   <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
 --}}
                            <div class="col-md-6">
                                <input id="email" placeholder="E-Mail" ype="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                          {{--   <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>
 --}}
                            <div class="col-md-6">
                                <input id="password"  placeholder="Hasło" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                       {{--      <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Potwierdź Hasło') }}</label> --}}

                            <div class="col-md-6">
                                <input id="password-confirm" placeholder="Powtórz hasło" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                     <br>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6">

                                    <p id="p-center">

                                     <button type="submit" class="btn btn-outline-secondary" id="button-1">
                                        {{ __('Zarejestruj się') }}
                                    </button>
                                </p>
                    
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <p id="p-center">
                            Posiadasz już konto?

                        </p>

                        <p id="p-center">
                            <b>   
                              <a href="{{ route('login') }}">
                                {{ __('Zaloguj się') }}
                            </a> 
                        </b>



                    </p>



                </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
