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
                                            <li class="breadcrumb-item active">Ajouter fournisseur</li>
                                        </ol>
                                        <h1 class="h2">Ajouter un fournisseur</h1>

                                        

                                        <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                            <div class="card-body">
                                                <div class="media flex-wrap align-items-center">
                                                    <div class="media-left col-md-9">
                                                        Ajouter un fournisseur 
                                                    </div>
                                                    <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                                        <a class="btn btn-success pull-right" href="<?php echo e(route('admin.index_fournisseur')); ?> "> <i class="fa fa-list"></i>&nbsp;Tous les fournisseurs</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="card">

                                            <?php if($errors->any()): ?>
                                            <div class="alert alert-danger alert-styled-left login-form">
                                              <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                            class="sr-only">Close</span></button>
                                            <ul>
                                              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <li> <span class="text-semibold"> <?php echo e($error); ?></span></li>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            </div>
                                            <?php endif; ?>

                                            <form method="post" action="<?php echo e(route('admin.store_fournisseur')); ?>" enctype="multipart/form-data"   >
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
                                                                <label id="nom" for="description-Nom" class="col-md-3 col-form-label form-label">Nom</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input id="nom_frns"  type="text" name="nom_frns" placeholder="Nom fournisseur"  class="form-control form-control-prepended" value="<?php echo e(old('nom_frns')); ?>">
                                                                        
                                                                    </div>
                                                                    <small id="description-Nom" class="form-text text-muted">Nom fournisseur.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    
                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="tel" for="description-tel" class="col-md-3 col-form-label form-label">N° Téléphone</label>
                                                                <div class="col-md-9">
                                                                    <div role="group" class="input-group input-group-merge">
                                                                        <input  value="<?php echo e(Request::old('tel')); ?>"   id="tel" name="tel" type="phone" placeholder="N° téléphone fournisseur"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                    </div>
                                                                    <small id="description-tel" class="form-text text-muted">N° Téléphone fournisseur.</small>
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
                                                                        <input value="<?php echo e(Request::old('email')); ?>"   id="email" name="email" type="email" placeholder="Email fournisseur"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                                    </div>
                                                                    <small id="description-profileage" class="form-text text-muted">Email fournisseur.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-adresse" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="adress" for="adresse" class="col-md-3 col-form-label form-label">Adresse</label>
                                                                <div class="col-md-9">
                                                                    <textarea id="adress" name="adress" placeholder="adresse ..." rows="3" class="form-control"><?php echo e(old('adress')); ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-group-item">
                                                        <div role="group" aria-labelledby="label-remarque" class="m-0 form-group">
                                                            <div class="form-row">
                                                                <label id="remarque" for="remarque" class="col-md-3 col-form-label form-label">Remarque</label>
                                                                <div class="col-md-9">
                                                                    <textarea id="remarque" name="remarque" placeholder="Remarque ..." rows="3" class="form-control"><?php echo e(old('remarque')); ?></textarea>
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

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/c2mserver/public_html/caisse.gcmi.store/resources/views/Admin/fournisseur/add.blade.php ENDPATH**/ ?>