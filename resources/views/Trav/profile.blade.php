@extends('Dir.main')
@section('script')
@endsection
@section('content')
<div class="mdk-drawer-layout__content page ">
    <!-- Header Layout Content -->
    <!-- Header Layout Content -->
    <div class="container-fluid page__container p-0">
        
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trav.index') }}">Accueil</a></li>
            <li class="breadcrumb-item active">Modifier le compte</li>
        </ol>
        <h1 class="h2">Modifier le compte</h1>
        
        @if (session('success'))
        <div class="alert alert-success border-1 border-left-3 border-left-success d-flex alert-dismissible">
            
            <i class="material-icons text-success mr-3">check_circle</i>
            <div class="text-body">{{ session('success') }}</div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        @if (session('error') )
        <div class="alert alert-danger alert-styled-left login-form">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
        class="sr-only">Close</span></button>
        <span class="text-semibold"> {{ session('error') }}</span>
    </div>
    @endif
    @if ($errors->has('password'))
    <div class="alert alert-danger alert-styled-left login-form">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
    class="sr-only">Close</span></button>
    <span class="text-semibold"> Votre opération n'a pas été complétée avec succès</span>
</div>
@endif

    <div class="card">
    <div class="card-body">        
            <form enctype="multipart/form-data"  action="{{ route('trav.editDirectionPost') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label for="avatar" class="col-sm-3 col-form-label form-label">Profil</label>
                    <div class="col-sm-9">
                        <div class="media align-items-center">
                            <div class="media-left">
                                
                                <img width="70" src="{{ url('/images/direction/'.Auth::user()->img) }}" class="icon-block rounded">
                                
                            </div>
                            <div class="media-body">
                                <div class="custom-file" style="width: auto;">
                                    <input type="file" id="avatar" name="image" class="custom-file-input">
                                    <label for="avatar" class="custom-file-label">Choisir fichier</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label form-label">Nom/Prenom</label>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="name" name="nom" type="text" class="form-control" placeholder="Nom" value="{!! Auth::user()->nom !!}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="prenom" class="form-control" placeholder="Prenom" value="{!! Auth::user()->prenom !!}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label form-label">Nom d'utilisateur</label>
                    <div class="col-sm-6 col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-user md-18 text-muted"></i>
                                </div>
                            </div>
                            <input type="text"  id="username" class="form-control" placeholder="User name" value="{!! Auth::user()->username !!}" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label form-label">Email</label>
                    <div class="col-sm-6 col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons md-18 text-muted">mail</i>
                                </div>
                            </div>
                            <input type="email"  id="email" class="form-control" placeholder="Email Address" value="{!! Auth::user()->email !!}"  name="email">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="website" class="col-sm-3 col-form-label form-label">Télèphone</label>
                    <div class="col-sm-6 col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons md-18 text-muted">phone</i>
                                </div>
                            </div>
                            <input type="text" id="website" name="tele" class="form-control" placeholder="Télèphone" value="{!! Auth::user()->tele !!}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="website" class="col-sm-3 col-form-label form-label">Grade</label>
                    <div class="col-sm-6 col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-user md-18 text-muted"></i>
                                </div>
                            </div>
                            <input type="text" id="grad" name="grad" class="form-control" placeholder="Grade" value="{!! Auth::user()->grad !!}">
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-8 offset-sm-3">
                        <div class="media align-items-center">
                            <div class="media-left">
                                <button type="submit" class="btn btn-success">Sauvegarder </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
     <div class="card">
    <div class="card-body">
            <form action="{{ route('trav.editDirectionPasswordPost') }}" method="POST"  class="form-horizontal" >
                @csrf
                <br>
                <div class="form-group row">
                    <label for="Ancien" class="col-sm-3 col-form-label form-label">Ancien mot de passe</label>
                    <div class="col-sm-6 col-md-4">
                        <input id="Ancien" type="password" name="Ancien" class="form-control" placeholder="ancien mot de passe" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passe" class="col-sm-3 col-form-label form-label">Mot de passe</label>
                    <div class="col-sm-6 col-md-4">
                        <input id="passe" type="password" name="password" class="form-control {{$errors->has('password') ? ' is-invalid' : ''}}" placeholder="Mot de passe">
                        @if($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="help-block text-danger-300">- {{$errors->first('password')}}
                            </strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Confirmer" class="col-sm-3 col-form-label form-label">Confirmer</label>
                    <div class="col-sm-6 col-md-4">
                        <input id="Confirmer" type="password" name="password_confirmation"  class="form-control" placeholder="Confirmer">
                        @if($errors->has('password_confirmation'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="help-block text-danger-300">- {{$errors->first('password_confirmation')}}
                            </strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-4 offset-sm-3">
                        <button type="submit" class="btn btn-success">Sauvegarder </button>
                    </div>
                </div>
            </form>
          </div>
      </div>
  </div>
</div>

@endsection