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
                                            <li class="breadcrumb-item active">Modifier les informations de la classe</li>
                                        </ol>
                                        <h1 class="h2">Modifier les informations de la classe</h1>

                                        <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                            <div class="card-body">
                                                <div class="media flex-wrap align-items-center">
                                                    <div class="media-left col-md-8">
                                                        Modifier les informations de la classe 
                                                    </div>
                                                    <div class="media-right  col-md-4 mt-2 mt-xs-plus-0 ">
                                                        <a class="btn btn-success pull-right" href="{{ route('classes') }} "> <i class="fa fa-list"></i>&nbsp;Tous les classes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Modifier information de la classe ({{$classe->nom}})</h4>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="{{url('/admin/modifier-classe')}}" >
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$classe->id}}">

                                                    @if (session('message'))
                                                        <div class="alert alert-success">
                                                            {{ session('message') }}
                                                        </div>

                                                    @endif

                                                    @if (session('message_error'))
                                                        <div class="alert alert-danger">
                                                            {{ session('message_error') }}
                                                        </div>
                                                    
                                                    @endif

                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Nom:</label>
                                                        <div class="col-sm-9">
                                                            <input id="nom" value="{{$classe->nom}}" name="nom" type="text" class="form-control" placeholder="Nom" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">nombre d'éléve:</label>
                                                        <div class="col-sm-9">
                                                            <input id="nbre_elev" value="{{@$classe->nbre_elev}}" name="nbre_elev" type="text" class="form-control" placeholder="Nombre  d'éléve" >
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Niveau:</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2-single  " name="id_niv" id="id_niv">
                                                                    @foreach($niveaux as $niveau)
                                                                    <?php 
                                                                        if($classe->id_niv==$niveau->id)
                                                                        {
                                                                            $selected="selected";
                                                                        }
                                                                        else
                                                                        {
                                                                            $selected="";
                                                                        }
                                                                    ?>
                                                                    <option {{$selected}} value="{{$niveau->id}}">{{$niveau->Desc_niveau}}</option>
                                                                    @endforeach
                                                            </select>
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
