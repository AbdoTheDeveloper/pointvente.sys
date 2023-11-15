@extends('Admin.main')

@section('content')
      <!-- Header Layout Content -->
         <!-- Header Layout Content -->
        
                <div class="mdk-drawer-layout__content page ">

                    <div class="">
                            
                            <div class="page pt-0">

                <div class="bg-primary mdk-box js-mdk-box mb-0" style="height: 192px;" data-effects="parallax-background blend-background">
                    <div class="mdk-box__bg">
                        <div class="mdk-box__bg-front" style="background-image: url({{ url('assets/images/1280_rsz_aman-dhakal-205796-unsplash.jpg')}}; background-position: center;"></div>
                    </div>
                </div>
                <div class="container page__container d-flex align-items-end position-relative mb-4">
                    <div class="avatar avatar-xxl position-absolute bottom-0 left-0 right-0">
                        <img src="{{ url('assets/images/256_rsz_clem-onojeghuo-150467-unsplash.jpg')}}" alt="avatar" class="avatar-img rounded-circle border-3">
                    </div>
                    <ul class="nav nav-tabs-links flex" style="margin-left: 265px;">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('etudiants') }} " class="nav-link">Tous les étudiants</a>
                        </li>
                    </ul>
                </div>

                <div class="container page__container mb-3">
                    <div class="row flex-sm-nowrap">
                        <div class="col-sm-auto mb-3 mb-sm-0" style="width: 265px;">
                            <h1 class="h2 mb-1">Laza Bogdan</h1>
                            <p class="d-flex align-items-center mb-4">
                                <a href="#" class="btn btn-sm btn-success mr-2">@établissement</a>
                            </p>
                            <div class="text-muted d-flex align-items-center mb-2">
                                <i class="material-icons mr-1">account_box</i>
                                <div class="flex">Student since 2012</div>
                            </div>
                            <div class="text-muted d-flex align-items-center mb-4">
                                <i class="material-icons mr-1">location_on</i>
                                <div class="flex">MAARIF Casablanca, Maroc</div>
                            </div>

                            <h4>À propos</h4>
                            <p class="text-black-70 measure-paragraph">Fueled by my passion for understanding the nuances of cross-cultural advertising, I consider myself a forever student, eager to both build on my academic foundations in psychology and sociology and stay in tune with the latest digital marketing strategies through continued coursework.</p>

                            
                        </div>
                        <div class="col-sm">
                            

                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <a href="fixed-student-take-course.html" class="mr-3">
                                            <img src="{{url('assets/images/vuejs.png')}}" width="100" alt="" class="rounded">
                                        </a>
                                        <div class="flex">
                                            <h4 class="card-title mb-0"><a href="fixed-student-take-course.html">VueJs</a></h4>
                                            <span class="badge badge-primary">Advanced</span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-group list-group-fit">
                                    <li class="list-group-item">
                                        <a href="fixed-student-view-course.html" class="text-body text-decoration-0 d-flex align-items-center">
                                            <strong>Basics of Vue.js</strong>
                                            <i class="material-icons text-muted ml-auto" style="font-size: inherit;">check</i>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="fixed-student-view-course.html" class="text-body text-decoration-0 d-flex align-items-center">
                                            <strong>Intermediate Vue.js</strong>
                                            <i class="material-icons text-muted ml-auto" style="font-size: inherit;">check</i>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="fixed-student-view-course.html" class="text-body text-decoration-0 d-flex align-items-center">
                                            <strong>Realtime Apps with Vue.js</strong>
                                            <i class="material-icons text-muted ml-auto" style="font-size: inherit;">check</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <a href="fixed-student-take-course.html" class="mr-3">
                                            <img src="{{url('assets/images/nodejs.png')}}" alt="" class="rounded" width="100">
                                        </a>
                                        <div class="flex">
                                            <h4 class="card-title mb-0"><a href="fixed-student-take-course.html">NodeJs</a></h4>
                                            <span class="badge badge-success">Beginner</span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-group list-group-fit">
                                    <li class="list-group-item">
                                        <a href="fixed-student-view-course.html" class="text-body text-decoration-0 d-flex align-items-center">
                                            <strong>Getting started with Node</strong>
                                            <i class="material-icons text-muted ml-auto" style="font-size: inherit;">check</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <a href="fixed-student-take-course.html" class="mr-3">
                                            <img src="{{url('assets/images/github.png')}}" alt="" class="rounded" width="100">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="card-title mb-0"><a href="fixed-student-take-course.html">GitHub</a></h4>
                                            <span class="badge badge-warning">Intermediate</span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-group list-group-fit">
                                    <li class="list-group-item">
                                        <a href="fixed-student-view-course.html" class="text-body text-decoration-0 d-flex align-items-center">
                                            <strong>Github Step by Step</strong>
                                            <i class="material-icons text-muted ml-auto" style="font-size: inherit;">check</i>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="fixed-student-view-course.html" class="text-body text-decoration-0 d-flex align-items-center">
                                            <strong>Working as a Team with GitHub</strong>
                                            <i class="material-icons text-muted ml-auto" style="font-size: inherit;">check</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                
                </div>
            </div>
                    </div>

                </div>
@endsection
