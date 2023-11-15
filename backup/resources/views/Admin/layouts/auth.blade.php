<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    
    <meta charset="utf-8">
    @include('Inc.style')
</head>
<body  class="authentication sidebar-collapse">
    <div class="overlay"></div>
    <nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
        <div class="container">
            <div class="navbar-translate n_logo">
                <a class="navbar-brand" href="javascript:void(0);" title="" target="_blank">Lycée Français International Jean Jaures</a>
                <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);">Search Result</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" title="Follow us on Twitter" href="javascript:void(0);" target="_blank">
                            <i class="zmdi zmdi-twitter"></i>
                            <p class="d-lg-none d-xl-none">Twitter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" title="Like us on Facebook" href="javascript:void(0);" target="_blank">
                            <i class="zmdi zmdi-facebook"></i>
                            <p class="d-lg-none d-xl-none">Facebook</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" title="Follow us on Instagram" href="javascript:void(0);" target="_blank">
                            <i class="zmdi zmdi-instagram"></i>
                            <p class="d-lg-none d-xl-none">Instagram</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-white btn-round" href="#">S'INSCRIRE</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="page-header" >
        <div class="page-header-image" style="background-image:url({{url('assets/images/login.jpg')}}"></div>
        <div class="container">
            <div class="col-md-12 content-center">
                <div class="card-plain">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <nav>
                    <ul>
                        <li><a href="javascript:void(0)" target="_blank">Contactez nous</a></li>
                        <li><a href="javascript:void(0)" target="_blank">À propos de nous</a></li>
                        <li><a href="javascript:void(0);">FAQ</a></li>
                    </ul>
                </nav>
                <div class="copyright">
                    &copy;
                    <script>
                    document.write(new Date().getFullYear())
                    </script>,
                    <span>Conçu par <a href="http://c2m.ma/" target="_blank">C2M</a></span>
                </div>
            </div>
        </footer>
    </div>
    <!-- Jquery Core Js -->
    @include('Inc.script')
</body>
</html>