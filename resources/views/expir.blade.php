<!DOCTYPE html>
<html lang="en" dir="ltr">
    
    <head>
        @include('Inc.style')
    </head>
    <body class="login">
        <div class="d-flex align-items-center" style="min-height: 100vh">
            <div class="col-sm-8 col-md-6 col-lg-4 mx-auto" style="min-width: 300px;">
                <div class="card navbar-shadow">
                    <div class="card-header text-center">
                        <img src="{{url('assets/images/logo.png')}}" width="200">
                    </div>
                    <div class="card-body">
                      
                                                
                                                
                                                <div class="log-box" style="background-color: white">
                                                    <h2>C2M <span class="theme-cl">SYSTEM</span></h2>
                                                    
                                                    @if (session('expir'))
                                                    <div class="alert alert-danger alert-styled-left alert-bordered login-form">
                                                        
                                                        <span class="text-semibold"> {{ session('expir') }}</span>
                                                    </div>
                                                    @endif
                                                   
                                                    <form method="POST" action="{{ route('active') }}" aria-label="{{ __('active') }}">
                                                        @csrf
                                                        
                                                        <div class="form-group m-0" role="group" aria-labelledby="label-question">
                                <div class="form-row align-items-center">
                                    
                                    
                                        <input id="question" type="text" name="code" value="{{old('code')}}"class="form-control">
                                    
                                </div>
                                                        
                                                        
                                                        
                                                            
                                                        </div>
<br>
<button type="submit" class="btn btn-success">Enter</button>                                                    </form>
                                                    <P style="color: red;font-weight: bold;">Essayez d'entrer code reparation contactez <br> C2M System Obligatoirement ....<br> Tel : 05 22 01 07 08 <br> E-mail : Contact@c2msystem.com </P>
                                                </div>
                                            
                                            </div>
                                        </div>
                                
                       
                </div>
            </div>

            
            
            
            @include('Inc.script')
        </body>
    </html>