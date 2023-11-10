<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
    
    <head>
        @include('Inc.style')
    </head>
    <body class=" layout-fluid">
        {{-- <div class="preloader">
            <div class="sk-double-bounce">
                <div class="sk-child sk-double-bounce1"></div>
                <div class="sk-child sk-double-bounce2"></div>
            </div>
        </div> --}}
        <!-- Header Layout -->
        <div class="mdk-header-layout js-mdk-header-layout">
           
            <div class="mdk-header-layout__content">
                <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
                        <div class="mdk-drawer-layout__content page ">

                            
                            @yield('content')
                                
                           


                </div>
                  
                    
                </div>

            </div>
            
        </div>
        
        @include('Inc.script')
    </body>
</html>