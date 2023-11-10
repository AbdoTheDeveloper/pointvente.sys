@extends('Prof.main')
@section('style')
<!-- Flatpickr -->
<link type="text/css" href="{{url('assets/css/quill.css')}}" rel="stylesheet">
<link type="text/css" href="{{url('assets/css/quill.rtl.css')}}" rel="stylesheet">
<!-- Touchspin -->
@endsection
@section('script')
@endsection
@section('content')
<div class="bg-primary mdk-box js-mdk-box mb-0" style="height: 192px;" data-effects="parallax-background blend-background">
    <div class="mdk-box__bg">
        <div class="mdk-box__bg-front" style="background-image: url({{ url('assets/images/classebanner.jpg')}}); background-position:bottom;"></div>
    </div>
</div>
<div class="container page__container d-flex align-items-end position-relative mb-4">
    <div class="avatar avatar-xxl position-absolute bottom-0 left-0 right-0">
        <img src="{{ url('/images/prof/'.Auth::user()->img) }}" alt="{{Auth::user()->nom}}" class="avatar-img rounded-circle border-3">
    </div>
    <br>
    <ul class="nav nav-tabs-links flex" style="margin-left: 265px;">
        <li class="nav-item">
            <a href="{{route('trav.prof.index')}}" class="nav-link active">Classes</a>
        </li>
        
    </ul>
    
</div>
<div class="container page__container mb-3">
    <div class="row flex-sm-nowrap" >
        
        <div class="col-sm-auto mb-3 mb-sm-0 stky" >
            <h1 class="h2 mb-1">{!! Auth::user()->nom.' '.Auth::user()->prenom!!}</h1>
            {{-- <p class="d-flex align-items-center mb-4">
                <a href="{{route('trav.prof.action.add')}}" class="btn btn-sm btn-success mr-2">Ajouter une action</a>
            </p> --}}
            <div class="text-muted d-flex align-items-center mb-2">
                <i class="material-icons mr-1">account_box</i>
                <div class="flex">{!! Auth::user()->discipline !!}</div>
            </div>
            <div class="text-muted d-flex align-items-center mb-2">
                <i class="material-icons mr-1">email</i>
                <div class="flex">{!! Auth::user()->email !!}</div>
            </div>
             <div class="text-muted d-flex align-items-center mb-2">
                <i class="material-icons mr-1">phone</i>
                <div class="flex">{!! Auth::user()->tele !!}</div>
            </div>
            
            
            <h4>Etablissement</h4>
           <div class="text-muted d-flex align-items-center mb-2">
                <i class="material-icons mr-1">account_box</i>
                <div class="flex">{!! Auth::user()->user->nom !!}</div>
            </div>
             <div class="text-muted d-flex align-items-center mb-2">
                <i class="material-icons mr-1">email</i>
                <div class="flex">{!! Auth::user()->user->email !!}</div>
             </div>
             <div class="text-muted d-flex align-items-center mb-2">
                <i class="material-icons mr-1">phone</i>
                <div class="flex">{!! Auth::user()->user->tele !!}</div>
            </div>
        </div>
        <div class="col-sm">
            <div class="flex search-form search-form--light mb-4">
                <button class="btn pr-3" type="button" role="button"><i class="material-icons">search</i></button>
                <input type="text" class="form-control" placeholder="Search" id="searchSample02">
            </div>
            @if (session('success'))
            <div class="alert alert-success border-1 border-left-3 border-left-success d-flex alert-dismissible">
                
                <i class="material-icons text-success mr-3">check_circle</i>
                <div class="text-body">{{ session('success') }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
            @foreach($classes as $cls )
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      
                             
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <h4 class="card-title m-0"><a href="#">{{@$cls->classe->nom}}</a></h4>
                                            </div>
                                            <div class="media-right">
                                                <div class="text-center">
                                                    <span class="badge badge-pill badge-success">{{@$cls->classe->nbre_elev}}</span>
                                                </div>
                                            </div>
                                        </div>
                                   
                               
                                <small class="text-muted"><strong> Niveau : </strong> {{@$cls->classe->niveau->Desc_niveau}}</small>
                           
                    </div>
                    
                    <div class="card-footer bg-white">
                        <a href="{{ route('trav.prof.action.add.classe',['id'=>$cls->classe->id]) }}" class="btn btn-primary btn-sm">Ajouter une action <i class="material-icons btn__icon--right">play_circle_outline</i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        </div>
    </div>
</div>
@endsection