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
                            

                            <h1 class="h2">Gérer les users</h1>
                             <div class="page ">


                                <div class="container page__container p-0">
                                    <div class="row m-0">
                                        <div class="col-lg container-fluid page__container">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                                <li class="breadcrumb-item active">Modifier les informations de la user</li>
                                            </ol>
                                            <h1 class="h2">Modifier les informations de la user</h1>

                                            <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                                <div class="card-body">
                                                    <div class="media flex-wrap align-items-center">
                                                        <div class="media-left col-md-9">
                                                            Modifier les informations de la user
                                                        </div>
                                                        <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                                            <a class="btn btn-success pull-right" href="{{ route('users') }} "> <i class="fa fa-list"></i>&nbsp;Tous les users</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h1 class="h2">Modifier informations user</h1>

                                            <div class="card">
                                                
                                               <form method="POST" action="{{route('edituserAdminPost')}}"  enctype="multipart/form-data"   >
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$user->id}}">

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
                                                    <div class="form-group row">
                                                        <label for="quiz_image" class="col-sm-3 col-form-label form-label">Logo user :</label>
                                                        <div class="col-sm-9 col-md-4">
                                                            <p><img alt="Jean Jaures - {{ utf8_decode($user->nom) }} " src="{{url('images/user/'.$user->logo)}}"   width="150" class="rounded">
                                                            </p>

                                                            
                                                                     <input
                                            class="fileupload"
                                            type="file"
                                            name="logo"
                                            id="logo"
                                            style="position: absolute;  clip: rect(0px, 0px, 0px, 0px); ">
                                            <div class="bootstrap-filestyle input-group">
                                                <span class="group-span-filestyle input-group-btn" tabindex="0">
                                                    <label for="logo" class="btn btn-default ">
                                                        
                                                        <span class="buttonText">Photo de profil</span>
                                                    </label>
                                                </span>
                                                <input type="text" class="form-control " placeholder="" disabled="">
                                                
                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>

                                                    
                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="username" for="profilename" class="col-md-3 col-form-label form-label">Login</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input value="{{$user->username}}" id="username" type="text" name="username" placeholder="Login user"  class="form-control form-control-prepended" aria-describedby="description-profilename"  >
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Login user.</small>
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
                                                                        <input id="nom" value="{{$user->nom}}" type="text" name="nom" placeholder="Nom user"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Nom user.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                   



                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="grad" for="profilename" class="col-md-3 col-form-label form-label">Grade</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">

                                                                        <select class="form-control select2-single  " name="grad" id="grad">
                                                                
                                                                            <option <?php if($user->grad=="Admin"){echo "selected";} ?> value="Admin">Admin</option>
                                                                            <option <?php if($user->grad=="User"){echo "selected";} ?> value="User">User</option>
                                                                           
                                                                    </select>
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Grade user.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    

                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="tele" for="profilename" class="col-md-3 col-form-label form-label">N° Téléphone</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input value="{{$user->tele}}" id="tele" name="tele" type="phone" placeholder="N° téléphone user"  class="form-control form-control-prepended" >
                                                                    </div>
                                                                    <small id="description-profileage" class="form-text text-muted">N° Téléphone user.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="email" for="profilename" class="col-md-3 col-form-label form-label">Email</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input value="{{$user->email}}" id="email" name="email" type="email" placeholder="Email user"  class="form-control form-control-prepended" >
                                                                    </div>
                                                                    <small id="description-profileage" class="form-text text-muted">Email user.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                   

                                                    <div class="list-group-item">
                                                        <div class="form-row">
                                                       
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Fournisseur :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_frns1" value="1" <?php if($user->p_frns=="1"){echo "checked";}?> name="p_frns" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_frns1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_frns2" value="0" <?php if($user->p_frns=="0"){echo "checked";}?>  name="p_frns" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_frns2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Eleve :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_eleve1" value="1" <?php if($user->p_eleve=="1"){echo "checked";}?>  name="p_eleve" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_eleve1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_eleve2" value="0" <?php if($user->p_eleve=="0"){echo "checked";}?>  name="p_eleve" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_eleve2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Travailleur :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_trav1" value="1" <?php if($user->p_trav=="1"){echo "checked";}?>  name="p_trav" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_trav1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_trav2" value="0" <?php if($user->p_trav=="0"){echo "checked";}?> name="p_trav" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_trav2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Stock :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_stock1" value="1" <?php if($user->p_stock=="1"){echo "checked";}?> name="p_stock" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_stock1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_stock2" value="0" <?php if($user->p_stock=="0"){echo "checked";}?> name="p_stock" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_stock2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Article :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_art1" value="1" <?php if($user->p_art=="1"){echo "checked";}?> name="p_art" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_art1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_art2" value="0"  <?php if($user->p_art=="0"){echo "checked";}?> name="p_art" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_art2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Categorie :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_cat1" value="1"  <?php if($user->p_cat=="1"){echo "checked";}?> name="p_cat" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_cat1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_cat2" value="0"  <?php if($user->p_cat=="0"){echo "checked";}?> name="p_cat" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_cat2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       
                                                        </div>
                                                    </div>

                                                    <div class="list-group-item">
                                                        <div class="form-row">

                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Classe :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_class1" value="1" <?php if($user->p_class=="1"){echo "checked";}?> name="p_class" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_class1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_class2" value="0" <?php if($user->p_class=="0"){echo "checked";}?> name="p_class" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_class2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Niveau :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_niv1" value="1"<?php if($user->p_niv=="1"){echo "checked";}?> name="p_niv" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_niv1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_niv2" value="0" <?php if($user->p_niv=="0"){echo "checked";}?> name="p_niv" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_niv2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Recette :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_recette1" value="1" <?php if($user->p_recette=="1"){echo "checked";}?> name="p_recette" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_recette1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_recette2" value="0" <?php if($user->p_recette=="0"){echo "checked";}?> name="p_recette" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_recette2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Parametrage :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_para1" value="1" <?php if($user->p_para=="1"){echo "checked";}?> name="p_para" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_para1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_para2" value="0" <?php if($user->p_para=="0"){echo "checked";}?> name="p_para" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_para2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Sauvegarde :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_save1" value="1" <?php if($user->p_save=="1"){echo "checked";}?> name="p_save" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_save1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_save2" value="0" <?php if($user->p_save=="0"){echo "checked";}?> name="p_save" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_save2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Utilisateur :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_users1" value="1" <?php if($user->p_users=="1"){echo "checked";}?> name="p_users" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_users1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_users2" value="0" <?php if($user->p_users=="0"){echo "checked";}?> name="p_users" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_users2">Non</label>
                                                                    </div>
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
                                          




                                            <h1 class="h2">Modifier mot de passe de la user</h1>



                                            <div class="card">

                                                

                                               <form method="POST" action="{{route('edituserAdminPasswordPost')}}" >
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$user->id}}">

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
                                                                        <input id="password" type="text" name="password" placeholder="Mot de passe user"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Mot de passe user.</small>
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
