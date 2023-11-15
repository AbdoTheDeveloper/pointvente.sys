



<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    
    $( document ).ready(function() {


                
  $(".fileupload" ).on( "change", function( event ) {

                $(this).next().children(".form-control").val($(this).val().replace(/.*[\/\\]/, ''));
});


});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                                            <li class="breadcrumb-item active">Ajouter user</li>
                                        </ol>
                                        <h1 class="h2">Ajouter un utilisateur</h1>

                                        

                                        <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                            <div class="card-body">
                                                <div class="media flex-wrap align-items-center">
                                                    <div class="media-left col-md-9">
                                                        Ajouter un utilisateur 
                                                    </div>
                                                    <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                                        <a class="btn btn-success pull-right" href="<?php echo e(route('users')); ?> "> <i class="fa fa-list"></i>&nbsp;Tous les users</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="card">
                                            <form method="post" action="<?php echo e(route('AddNouveauuser')); ?>" enctype="multipart/form-data"   >
                                            <?php echo e(csrf_field()); ?>


                                                <?php if(session('message')): ?>
                                                    <div class="alert alert-success">
                                                        <?php echo e(session('message')); ?>

                                                    </div>
                                                <?php endif; ?>

                                                <?php if(session('message_error')): ?>
                                                    <div class="alert alert-danger">
                                                        <?php echo e(session('message_error')); ?>

                                                    </div>
                                                <?php endif; ?>


                                                <div class="list-group list-group-fit">
                                              
                                            

                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="label-nom" for="nom" class="col-md-3 col-form-label form-label">Profil</label>
                                                                <div class="col-md-9">
                                                                    
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
                                                    </div>



                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="username" for="profilename" class="col-md-3 col-form-label form-label">Login</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input id="username" type="text" name="username" placeholder="Login user"  class="form-control form-control-prepended" aria-describedby="description-profilename"  value="<?php echo e(old('username')); ?>">
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Login user.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="username" for="profilename" class="col-md-3 col-form-label form-label">Mot de passe</label>
                                                                <div class="col-md-9">
                                                                    <div role="group"  class="input-group input-group-merge">
                                                                        <input value="<?php echo e(Request::old('password')); ?>" id="password" type="text" name="password"  placeholder="Mot de passe user"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Mot de passe user.</small>
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
                                                                        <input id="nom"  type="text" name="nom" placeholder="Nom user"  class="form-control form-control-prepended" value="<?php echo e(old('nom')); ?>">
                                                                        
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
                                                                
                                                                            <option <?php if(Request::old('grad')=="Admin"){echo "selected";} ?> value="Admin">Admin</option>
                                                                            <option <?php if(Request::old('grad')=="User"){echo "selected";} ?> value="User">User</option>
                                                                           
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
                                                                        <input value="<?php echo e(old('tele')); ?>" id="tele" name="tele" type="phone" placeholder="N° téléphone user"  class="form-control form-control-prepended" >
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
                                                                        <input value="<?php echo e(old('email')); ?>" id="email" name="email" type="email" placeholder="Email user"  class="form-control form-control-prepended" >
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
                                                                        <input type="radio" id="p_frns1" value="1" checked="" name="p_frns" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_frns1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_frns2" value="0" name="p_frns" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_frns2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Eleve :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_eleve1" value="1" checked="" name="p_eleve" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_eleve1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_eleve2" value="0" name="p_eleve" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_eleve2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Travailleur :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_trav1" value="1" checked="" name="p_trav" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_trav1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_trav2" value="0" name="p_trav" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_trav2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Stock :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_stock1" value="1" checked="" name="p_stock" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_stock1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_stock2" value="0" name="p_stock" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_stock2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Article :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_art1" value="1" checked="" name="p_art" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_art1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_art2" value="0" name="p_art" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_art2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Categorie :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_cat1" value="1" checked="" name="p_cat" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_cat1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_cat2" value="0" name="p_cat" class="custom-control-input">
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
                                                                        <input type="radio" id="p_class1" value="1" checked="" name="p_class" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_class1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_class2" value="0" name="p_class" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_class2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Niveau :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_niv1" value="1" checked="" name="p_niv" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_niv1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_niv2" value="0" name="p_niv" class="custom-control-input">
                                                                        <label class="custom-control-label"  p_nivr="promo_offre2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Recette :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_recette1" value="1" checked="" name="p_recette" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_recette1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_recette2" value="0" name="p_recette" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_recette2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Parametrage :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_para1" value="1" checked="" name="p_para" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_para1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_para2" value="0" name="p_para" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_para2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Sauvegarde :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_save1" value="1" checked="" name="p_save" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_save1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_save2" value="0" name="p_save" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_save2">Non</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-2">
                                                                <label for="remarque">Utilisateur :</label>
                                                                <div class="mb-4">
                                                                    <div style="display: inline-block;" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_users1" value="1" checked="" name="p_users" class="custom-control-input">
                                                                        <label class="custom-control-label"  for="p_users1">Oui</label>
                                                                    </div>
                                                                    <div style="display: inline-block;margin-left: 20px" class="custom-control custom-radio">
                                                                        <input type="radio" id="p_users2" value="0" name="p_users" class="custom-control-input">
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
                                    </div>
                                   
                                </div>
                            </div>

                            <?php echo $__env->make('Admin.inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>


                </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-installation\xampp-5.6\htdocs\pointvente.sys\resources\views/Admin/User/add.blade.php ENDPATH**/ ?>