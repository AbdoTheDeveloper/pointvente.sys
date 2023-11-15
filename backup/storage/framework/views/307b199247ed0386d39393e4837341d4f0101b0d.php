

<?php $__env->startSection('content'); ?>
      <!-- Header Layout Content -->
         <!-- Header Layout Content -->
        
                <div class="mdk-drawer-layout__content page ">

                    <div class="container-fluid page__container">
                            

                            <br><br>
                            
                             <div class="container page__container p-0">
                                <div class="row m-0">
                                    <div class="col-lg container-fluid page__container">
                                        <br>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                            <li class="breadcrumb-item active">Mise à jour des données </li>
                                        </ol>
                                        
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Mise à jour des données</h4>
                                            </div>
                                            

            <div class="card-body">
                <form method="POST" action="<?php echo e(route('editEtablissementPost')); ?>"  enctype="multipart/form-data"   >
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id" value="<?php echo e($etablissement->id); ?>">

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

 <div class="form-group row">
                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Email :</label>
                        <div class="col-sm-9">
                            <input id="nom" name="email" type="email" class="form-control" value="<?php echo e($etablissement->email); ?>" placeholder="email" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Dénomination :</label>
                        <div class="col-sm-9">
                            <input id="nom" name="nom" type="text" class="form-control" value="<?php echo e($etablissement->nom); ?>" placeholder="Dénomination d'établissement" >
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Tel:</label>
                        <div class="col-sm-9">
                            <input id="tele" name="tele" type="text" class="form-control" placeholder="N° téléphone d'établissement" value="<?php echo e($etablissement->tele); ?>" >
                        </div>
                    </div>

                   
                    <div class="form-group row">
                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Message :</label>
                        <div class="col-sm-9">
                            <input id="msg" name="msg" type="text" class="form-control" placeholder="Message" value="<?php echo e($etablissement->msg); ?>" >
                        </div>
                    </div>

                   
                    
                     
                    <div class="form-group row">
                        <label for="quiz_image" class="col-sm-3 col-form-label form-label">Logo :</label>
                        <div class="col-sm-9 col-md-4">

                            <?php if( file_exists( public_path().'/user//'.$etablissement->logo) && !is_null($etablissement->logo)): ?> 
                                <p><img alt="Jean Jaures  - <?php echo e(utf8_decode($etablissement->nom)); ?> " src="<?php echo e(url('user/'.$etablissement->logo)); ?>"   width="150" class="rounded"></p>
                            <?php else: ?>
                                <p><img alt="Jean Jaures Logo" src="<?php echo e(url('assets/images/logo.png')); ?>" width="150" class="rounded" ></p>
                            <?php endif; ?>


                            <div class="custom-file">
                                <input type="file" id="quiz_image" class="custom-file-input" name="logo">
                                <label for="quiz_image" class="custom-file-label">Changer Logo</label>
                            </div>
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



                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Changer mot de passe</h4>
                                            </div>
                                            <div class="card-body">
                                                
                                                 <form method="POST" action="<?php echo e(route('editEtablissementPasswordPost')); ?>"  enctype="multipart/form-data"   >
                                                    <?php echo e(csrf_field()); ?>

                                                    <input type="hidden" name="id" value="<?php echo e($etablissement->id); ?>">

                                                    <?php if(session('message_error_password')): ?>
                                                        <div class="alert alert-danger">
                                                            <?php echo e(session('message_error_password')); ?>

                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if(session('message_password')): ?>
                                                        <div class="alert alert-success">
                                                            <?php echo e(session('message_password')); ?>

                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Ancien mot de passe:</label>
                                                        <div class="col-sm-9">
                                                            <input value="<?php echo e(Request::old('ancien_password')); ?>" id="ancien_password" name="ancien_password" type="password" class="form-control" placeholder="Ancien mot de passe" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Nouveau mot de passe:</label>
                                                        <div class="col-sm-9">
                                                            <input  value="<?php echo e(Request::old('nouveau_password')); ?>" id="nouveau_password" name="nouveau_password" type="password" class="form-control" placeholder="Nouveau mot de passe " >
                                                        </div>
                                                    </div>



                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Confirmation mot de passe:</label>
                                                        <div class="col-sm-9">
                                                            <input value="<?php echo e(Request::old('confirm_password')); ?>" id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirmation mot de passe" >
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

                            <?php echo $__env->make('Admin.inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>


                </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-installations\xampp5.6\htdocs\pointvente.sys\resources\views/Admin/Etablissement/index.blade.php ENDPATH**/ ?>