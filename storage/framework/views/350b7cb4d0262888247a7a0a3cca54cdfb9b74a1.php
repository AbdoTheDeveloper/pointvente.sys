


<?php $__env->startSection('script'); ?>

<script type="text/javascript">
  $("select[name='id_niv']").change(function(){
      var id_niv = $(this).val();
      var token = $("input[name='_token']").val();
    
      $.ajax({
          url: "<?php echo route('select-niveau-classes-etudiant') ?>",
          method: 'POST',
          data: {id_niv:id_niv, _token:token},
          success: function(data) {
         
            console.log(data);
            $("#id_class").html('');
            $("#id_class").html(data.options);
          }
      });
  });
</script>
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
                            

                            <h1 class="h2">Gérer les clients</h1>
                             <div class="page ">


                                <div class="container page__container p-0">
                                    <div class="row m-0">
                                        <div class="col-lg container-fluid page__container">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                                <li class="breadcrumb-item active">Modifier compte</li>
                                            </ol>
                                            <h1 class="h2">Modifier informations clients</h1>

                                            <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                                <div class="card-body">
                                                    <div class="media flex-wrap align-items-center">
                                                        <div class="media-left col-md-9"><?php echo e(@$eleve->nom); ?> <?php echo e(@$eleve->prenom); ?>

                                                        </div>
                                                        <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                                            <a class="btn btn-success pull-right" href="<?php echo e(route('etudiants')); ?> "> <i class="fa fa-list"></i>&nbsp;Tous les clients</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h1 class="h2">Modifier informations clients</h1>

                                            <div class="card">
                                                
                                               <form method="POST" action="<?php echo e(route('editEtudiantPost')); ?>" enctype="multipart/form-data"   >
                                                    <?php echo e(csrf_field()); ?>

                                                    <input type="hidden" name="id" value="<?php echo e($eleve->id); ?>">

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
                                                    <div class="form-group row">
                                                        <label for="quiz_image" class="col-sm-3 col-form-label form-label">Logo du clients :</label>
                                                        <div class="col-sm-9 col-md-4">
                                                            <p><img alt="Jean Jaures  - <?php echo e(utf8_decode($eleve->nom)); ?> " src="<?php echo e(url('images/eleve/'.$eleve->img)); ?>"   width="150" class="rounded">
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
                                                                <label id="username" for="profilename" class="col-md-3 col-form-label form-label">Matricule</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input value="<?php echo e($eleve->username); ?>" id="username" type="text" name="username" placeholder="Matricule"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Matricule.</small>
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
                                                                        <input value="<?php echo e($eleve->nom); ?>" id="nom" type="text" name="nom" placeholder="Nom"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Nom d'élèves.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="prenom" for="profilename" class="col-md-3 col-form-label form-label">Prénom</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input value="<?php echo e($eleve->prenom); ?>" id="prenom" name="prenom" type="text" placeholder="Prénom"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                       
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Prénom .</small>
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
                                                                        <input value="<?php echo e($eleve->tele); ?>" id="tele" name="tele" type="phone" placeholder="N° Téléphone d'élèves"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                    </div>
                                                                    <small id="description-profileage" class="form-text text-muted">N° Téléphone .</small>
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
                                                                        <input value="<?php echo e($eleve->email); ?>" id="email" name="email" type="email" placeholder="Email d'élèves"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                    </div>
                                                                    <small id="description-profileage" class="form-text text-muted">Email .</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-adresse" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="adress" for="adresse" class="col-md-3 col-form-label form-label">Adresse</label>
                                                                <div class="col-md-9">
                                                                    <textarea id="adress" name="adress" placeholder="Votre adresse ..." rows="3" class="form-control"><?php echo e($eleve->adress); ?></textarea>
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
                                          <!--  <h1 class="h2">Modifier classe d'élèves</h1>
                                            <h5 class="h2">La classe  actuelle d'élève  est <b><?php echo e(@$eleve->classe->nom); ?></b>.</h5>


                                            <div class="card">
                                                
                                                
                                               <form method="POST" action="<?php echo e(route('editEtudiantClassePost')); ?>" >
                                                    <?php echo e(csrf_field()); ?>

                                                    <input type="hidden" name="id" value="<?php echo e($eleve->id); ?>">

                                                <?php if(session('message_update_classe_success')): ?>
                                                    <div class="alert alert-success">
                                                        <?php echo e(session('message_update_classe_success')); ?>

                                                    </div>
                                                    <br><br>
                                                <?php endif; ?>

                                                <?php if(session('message_update_classe_error')): ?>
                                                    <div class="alert alert-danger">
                                                        <?php echo e(session('message_update_classe_error')); ?>

                                                    </div>
                                                    <br><br>
                                                <?php endif; ?>

                                                <div class="list-group list-group-fit">
                                              
                                            



                                                   <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-adresse" class="m-0 form-group">
                                                           <div class="form-row">
                                                                <label for="quiz_title" class="col-sm-3 col-form-label form-label">Niveau:</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control select2-single   form-control-prepended" name="id_niv" id="id_niv">
                                                                        <option value="">Séléctionnez niveau</option>
                                                                        <?php $__currentLoopData = $niveaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $niveau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($niveau->id); ?>"><?php echo e($niveau->Desc_niveau); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                    </select> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-adresse" class="m-0 form-group">
                                                           <div class="form-row">
                                                                <label for="quiz_title" class="col-sm-3 col-form-label form-label">Classe:</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control select2-single  " name="id_class" id="id_class">
                                                                           <option>Classe d'élèves actuelle est <b><?php echo e(@$eleve->classe->nom); ?></b></option>
                                                                    </select>

                                                                   
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
-->


                                            <h1 class="h2">Modifier mot de passe du client</h1>



                                            <div class="card">
                                                
                                               <form method="POST" action="<?php echo e(url('/admin/modifier-password-etudiants')); ?>" >
                                                    <?php echo e(csrf_field()); ?>

                                                    <input type="hidden" name="id" value="<?php echo e($eleve->id); ?>">

                                                <?php if(session('message_update_password_success')): ?>
                                                    <div class="alert alert-success">
                                                        <?php echo e(session('message_update_password_success')); ?>

                                                    </div>
                                                    <br><br>
                                                <?php endif; ?>

                                                <?php if(session('message_update_password_error')): ?>
                                                    <div class="alert alert-danger">
                                                        <?php echo e(session('message_update_password_error')); ?>

                                                    </div>
                                                    <br><br>
                                                <?php endif; ?>

                                                <div class="list-group list-group-fit">
                                              
                                            

                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="username" for="profilename" class="col-md-3 col-form-label form-label">Mot de passe</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input id="password" type="text" name="password" placeholder="Mot de passe du client"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                        
                                                                    </div>
                                                                    <small id="description-profilename" class="form-text text-muted">Mot de passe du client.</small>
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


                </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-installations\xampp5.6\htdocs\pointvente.sys\resources\views/Admin/Etudiant/update.blade.php ENDPATH**/ ?>