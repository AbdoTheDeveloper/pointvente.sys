@extends('Admin.main')
@section('script')
<script type="text/javascript">
    
    $( document ).ready(function() {


                
  $(".fileupload" ).on( "change", function( event ) {

                $(this).next().children(".form-control").val($(this).val().replace(/.*[\/\\]/, ''));
});


});
</script>
@endsection



@section('content')
      <!-- Header Layout Content -->
         <!-- Header Layout Content -->
        
                <div class="mdk-drawer-layout__content page ">

                    <div class="container-fluid page__container">
                            

                            <h1 class="h2">Gérer les travailleurs</h1>
                             <div class="page ">


                                <div class="container page__container p-0">
                                    <div class="row m-0">
                                        <div class="col-lg container-fluid page__container">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                                <li class="breadcrumb-item active">Modifier les informations de le travailleur</li>
                                            </ol>
                                            <h1 class="h2">Modifier les informations de le travailleur</h1>

                                            <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                                <div class="card-body">
                                                    <div class="media flex-wrap align-items-center">
                                                        <div class="media-left col-md-9">
                                                            Modifier les informations de le travailleur
                                                        </div>
                                                        <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                                            <a class="btn btn-success pull-right" href="{{ route('admin.index_travailleur') }} "> <i class="fa fa-list"></i>&nbsp;Tous les travailleurs</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h1 class="h2">Modifier informations travailleur</h1>

                                            <div class="card">
                                                
                                               <form method="POST" action="{{route('admin.update_travailleur')}}"  enctype="multipart/form-data"   >
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$travailleur->id}}">

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

                                                <div class="list-group list-group-fit">
                                              
                                                   
                                                    
                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="username" for="profilename" class="col-md-3 col-form-label form-label">Login</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input value="{{$travailleur->username}}" id="username" type="text" name="username" placeholder="Login travailleur"  class="form-control form-control-prepended" aria-describedby="description-profilename"  >
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Username travailleur.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                   


                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="nom" for="profilename" class="col-md-3 col-form-label form-label">Nom</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input id="nom" value="{{$travailleur->nom}}" type="text" name="nom" placeholder="Nom travailleur"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Nom travailleur.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Type Categorie:</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2-single  " name="type" id="type">
                                                                
                                                                <option <?php if($travailleur->type=="R"){echo "selected";} ?> value="R">Restaurant</option>
                                                                <option <?php if($travailleur->type=="B"){echo "selected";} ?> value="B">Buvette</option>
                                                               
                                                        </select>
                                                            </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Peut imprimer des factures :</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2-single  " name="canprint" id="canprint">
                                                                
                                                                <option <?php if($travailleur->canprint=="1"){echo "selected";} ?> value="1">OUI</option>
                                                                <option <?php if($travailleur->canprint=="0"){echo "selected";} ?> value="0">NON</option>
                                                               
                                                        </select>
                                                            </div>
                                                    </div>


                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="grad" for="profilename" class="col-md-3 col-form-label form-label">Mode Caisse</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input value="{{$travailleur->modeCaisse}}" id="modeCaisse" name="modeCaisse" type="text" placeholder="Mode Caisse"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                       
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Mode Caisse.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    

                                                  

                                                    
                                                    <div class="list-group-item">
                                                        <div class="form-group row mb-0">
                                                            <div class="col-sm-9 offset-sm-3">
                                                                <button type="submit" class="btn btn-success pull-right">Enregistrer</button>
                                                            </div>
                                                        </div>
                                                     </div>

                                                </div>
                                            </form>

                                            </div>
                                          




                                            <h1 class="h2">Modifier mot de passe de le travailleur</h1>
                                            <div class="card">
                                                
                                                <form method="POST" action="{{route('Admin.Trav.updatePassword')}}" >
                                                     {{ csrf_field() }}
                                                     <input type="hidden" name="id" value="{{$travailleur->id}}">
 
                                                 @if (session('message_update_password_success'))
                                                     <div class="alert alert-success">
                                                         {{ session('message_update_password_success') }}
                                                     </div>
                                                     <br><br>
                                                 @endif
 
                                                 @if (session('message_update_password_error'))
                                                     <div class="alert alert-danger">
                                                         {{ session('message_update_password_error') }}
                                                     </div>
                                                     <br><br>
                                                 @endif
 
                                                 <div class="list-group list-group-fit">
                                               
                                             
 
                                                     <div class="list-group-item">
                                                         <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                             <div class="form-row">
                                                                 <label id="username" for="profilename" class="col-md-3 col-form-label form-label">Mot de passe</label>
                                                                 <div class="col-md-9">
                                                                     <div role="group" class="input-group input-group-merge">
                                                                         <input id="password" type="text" name="password" placeholder="Mot de passe travailleur"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                         
                                                                     </div>
                                                                     <small id="description-profilename" class="form-text text-muted">Mot de passe travailleur.</small>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
 
 
                                                     
 
 
                                                     
                                                     <div class="list-group-item">
                                                         <div class="form-group row mb-0">
                                                             <div class="col-sm-9 offset-sm-3">
                                                                 <button type="submit" class="btn btn-success pull-right">Enregistrer</button>
                                                             </div>
                                                         </div>
                                                      </div>
 
                                                 </div>
                                             </form>
 
                                             </div>
 


                                            

                                        </div>
                                       
                                    </div>
                                </div>

                                @include('Admin.inc.footer')

            </div>
                    </div>


                </div>
@endsection
