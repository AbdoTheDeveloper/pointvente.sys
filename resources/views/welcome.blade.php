<!DOCTYPE html>
<html lang="en" dir="ltr">
    
    <head>
        @include('Inc.style')
    </head>
    <body class="login" >
        <div class="d-flex align-items-center" style="min-height: 100vh; background: url({{url('assets/images/back.jpg')}});background-position: center;
        background-size: 100%;
        background-repeat: no-repeat;">
            <div class="col-sm-8 col-md-8 col-lg-8 mx-auto" style="min-width: 300px;">
                <div class="card navbar-shadow">
                    <div class="card-header text-center">
                        <img src="{{url('assets/images/logo.png')}}" width="200">
                    </div>
                    <div class="card-body">
                        <div class="row">


                            
                            <div class="col-md-6">
                                <div  class="text-center">
                                   <a href="{{route('admin.login')}}">
                                    <img src="{{url('assets/images/pro/ad.png')}}"  width="40%"  >
                                    <br>
                                    <div class="page-separator__text"> Espace Administrateur</div>
                                    </a>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div  class="text-center">
                             <a href="{{route('trav.login')}}">
                                    <img src="{{url('assets/images/pro/pa.png')}}"  width="40%"  >
                                    <br>
                                    <div class="page-separator__text"> Espace Travailleurs </div>
                                </a>
                                </div>
                                
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        @include('Inc.script')
    </body>
</html>