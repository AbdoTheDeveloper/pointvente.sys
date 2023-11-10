<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
    
    <head>
       @include('Inc.admin.style')
    </head>

<body class=" layout-fluid">

    <div class="preloader">
        <div class="sk-double-bounce">
            <div class="sk-child sk-double-bounce1"></div>
            <div class="sk-child sk-double-bounce2"></div>
        </div>
    </div>


      <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">


        @include('Admin.inc.nav')
        
         <div class="mdk-header-layout__content">
        <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        @yield('content')
       
        @include('Admin.inc.side')

        </div>
            </div>
        </div>
        
        @include('Inc.admin.script')
    </body>
</html>
