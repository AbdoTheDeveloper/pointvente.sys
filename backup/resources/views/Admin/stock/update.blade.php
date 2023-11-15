@extends('Admin.main')

@section('content')
      <!-- Header Layout Content -->
         <!-- Header Layout Content -->
        
                <div class="mdk-drawer-layout__content page ">

                    <div class="container-fluid page__container">
                            

                            <br><br>
                            
                             <div class="container page__container p-0">
                                <div class="row m-0">
                                    <div class="col-lg container-fluid page__container">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                            <li class="breadcrumb-item active">Modifier les informations du niveau</li>
                                        </ol>
                                        <h1 class="h2">Modifier les informations du niveau</h1>

                                        <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                            <div class="card-body">
                                                <div class="media flex-wrap align-items-center">
                                                    <div class="media-left col-md-8">
                                                        Modifier les informations du niveau 
                                                    </div>
                                                    <div class="media-right  col-md-4 mt-2 mt-xs-plus-0 ">
                                                        <a class="btn btn-success pull-right" href="{{ route('niveau') }} "> <i class="fa fa-list"></i>&nbsp;Tous les stocks</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Modifier les informations du niveau ({{$niveau->Desc_niveau}})</h4>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="{{url('/admin/modifier-niveau')}}" >
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$niveau->id}}">

                                                    @if (session('message'))
                                                        <div class="alert alert-success">
                                                            {{ session('message') }}
                                                        </div>
                                                    @endif

                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Niveau:</label>
                                                        <div class="col-sm-9">
                                                            <input id="Desc_niveau" name="Desc_niveau" type="text" value="{{$niveau->Desc_niveau}}" class="form-control" placeholder="Niveau" >
                                                        </div>
                                                    </div>


                                                    <div class="form-group row mb-0">
                                                        <div class="col-sm-9 offset-sm-3">
                                                            <button type="submit" class="btn btn-success pull-right">Enregistrer</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>

                            @include('Admin.inc.footer')
                    </div>

                </div>
@endsection
