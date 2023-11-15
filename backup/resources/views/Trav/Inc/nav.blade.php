  <div id="header" data-fixed class="mdk-header js-mdk-header mb-0">
            <div class="mdk-header__content">

                <!-- Navbar -->
                <nav id="default-navbar" class="navbar navbar-expand navbar-dark bg-primary m-0">
                    <div class="container-fluid">
                        <!-- Toggle sidebar -->
                        <button class="navbar-toggler d-block" data-toggle="sidebar" type="button">
                            <span class="material-icons">menu</span>
                        </button>

                        <!-- Brand -->
                        <a href="{{ route('trav.index') }}" class="navbar-brand">
                           <span class="d-none d-xs-md-block">{{ Auth::user()->etab->nom }}</span>
                        </a>

                        <!-- Search -->
                      {{--   <form class="search-form d-none d-md-flex">
                            <input type="text" class="form-control" placeholder="Search">
                            <button class="btn" type="button"><i class="material-icons font-size-24pt">search</i></button>
                        </form> --}}
                        <!-- // END Search -->

                        <div class="flex"></div>

                      

                        <!-- Menu -->
                        <ul class="nav navbar-nav flex-nowrap">

                          

                            <!-- // END Notifications dropdown -->
                            <!-- User dropdown -->

                            <li class="nav-item dropdown ml-1 ml-md-3">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">

                                   

                                     @if( file_exists( public_path().'images/direction'.Auth::user()->img) && !is_null(Auth::user()->logo)) 
                                    

                                        <img src="{{url('images/direction/'.Auth::user()->img)}}" alt="Jean Jaures  - {{ utf8_decode(Auth::user()->nom) }} " class="rounded-circle" width="40" height="40">

                                    @else
                                      
                                        <img src="{{url('assets/images/logo.png')}}" alt="Louis Jean Jaures logo " class="rounded-circle" width="40" height="40">
                                    @endif




                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('trav.index') }}">
                                        <i class="material-icons">edit</i>Profil
                                    </a>
                                    <a class="dropdown-item" href="{{ route('trav.logout') }}">
                                        <i class="material-icons">lock</i> Déconnexion
                                    </a>
                                </div>
                            </li>
                            <!-- // END User dropdown -->

                        </ul>
                        <!-- // END Menu -->
                    </div>
                </nav>
                <!-- // END Navbar -->

            </div>
        </div>
