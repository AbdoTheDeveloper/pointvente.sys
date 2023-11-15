<!DOCTYPE html>
<html lang="en" dir="ltr">
 
    <head>
        @include('Inc.style')
    </head>
        <body class="login">
            <div class="d-flex align-items-center" style="min-height: 100vh ;  background: url({{url('assets/images/back.jpg')}});background-position: center;
            background-size: 100%;
            background-repeat: no-repeat;">
                <div class="col-sm-8 col-md-8 col-lg-8 mx-auto" style="min-width: 300px;">
                    <div class="card navbar-shadow">
                        {{-- <div class="card-header text-center">
                            <img src="{{url('assets/images/logo.png')}}" width="100">
                        </div> --}}
                        <div class="card-body">
                          {{-- <div  class="text-center">
                          <img src="@yield('espaceimg')"   >
                          </div> --}}
                            <div class="page-separator">
                                <div class="page-separator__text"> @yield('espace')</div>
                            </div>

                            @yield('content')
                            
                        </div>
                        <div class="card-footer text-center text-black-50">
                           
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            
          
            
            @include('Inc.script')
        </body>
        </html>