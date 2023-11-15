@extends('Admin.layouts.auth')

@section('content')

 <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="header">
                        <div class="logo-container">
                            <img src="assets/images/logo.png" alt="">
                        </div>
                        <h5>{{ __('S\'identifier') }}</h5>
                    </div>
                    <div class="content">                                                
                        <div class="input-group">
                            <input type="text"  name="email"  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}"  value="{{ old('email') }}" required autofocus>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-account-circle"></i>
                            </span>
                              @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="input-group">
                            <input type="password" placeholder="{{ __('Password') }}" class="form-control" {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                              @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group row">
                          
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Souviens-toi de moi') }}
                                    </label>
                                </div>
                           
                        </div>

                        <div class="footer text-center">
                          
                                <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">
                                    {{ __('Connecter') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                           
                        </div>
                   
                </form>

@endsection
