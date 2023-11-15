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
                            <li class="breadcrumb-item"><a href="fixed-student-dashboard.html">Accueil</a></li>
                            <li class="breadcrumb-item active">Ajouter un client</li>
                        </ol>
                        <h1 class="h2">Ajouter un nouveau client</h1>
                        
                        <div class="card border-left-3 border-left-primary card-2by1 mt50">
                            <div class="card-body">
                                <div class="media flex-wrap align-items-center">
                                    <div class="media-left col-md-9">
                                        Ajouter un nouveau client
                                    </div>
                                    <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                        <a class="btn btn-success pull-right" href="<?php echo e(route('etudiants')); ?> "> <i class="fa fa-list"></i>&nbsp;Tous les clients</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <form method="post" action="<?php echo e(url('/admin/AddNouveauEleve')); ?>" enctype="multipart/form-data"   >
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
                                                <label id="username" for="profilename" class="col-md-3 col-form-label form-label">Matricule </label> <div class="col-md-9">
                                                <div role="group" class="input-group input-group-merge">
                                                    <input  value="<?php echo e(Request::old('username')); ?>" id="username" type="text" name="username" placeholder="Matricule"  class="form-control form-control-prepended" aria-describedby="description-profilename"> </div>
                                                <small id="description-profilename" class="form-text text-muted">Matricule
                                            du client.</small> </div> </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                            <div class="form-row">
                                                <label id="username" for="profilename" class="col-md-3 col-form-label form-label">Mot de passe</label>
                                                <div class="col-md-9">
                                                    <div role="group" class="input-group input-group-merge">
                                                        <input value="<?php echo e(Request::old('password')); ?>" id="password" type="text" name="password" placeholder="Mot de passe du client"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                        
                                                    </div>
                                                    <small id="description-profilename" class="form-text text-muted">Mot de passe.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                            <div class="form-row">
                                                <label id="nom"  value="<?php echo e(old('nom')); ?>" for="profilename" class="col-md-3 col-form-label form-label">Nom</label>
                                                <div class="col-md-9">
                                                    <div role="group" class="input-group input-group-merge">
                                                        <input value="<?php echo e(Request::old('nom')); ?>" id="nom" type="text" name="nom" placeholder="Nom"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                        
                                                    </div>
                                                    <small id="description-profilename" class="form-text text-muted">Nom</small>
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
                                                        <input value="<?php echo e(Request::old('prenom')); ?>"   id="prenom" name="prenom" type="text"  placeholder="Prénom"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                        
                                                    </div>
                                                    <small id="description-profilename" class="form-text text-muted">Prénom.</small>
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
                                                        <input  value="<?php echo e(Request::old('tele')); ?>"   id="tele" name="tele" type="phone" placeholder="N° téléphone"  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                    </div>
                                                    <small id="description-profileage" class="form-text text-muted">N° Téléphone.</small>
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
                                                        <input value="<?php echo e(Request::old('email')); ?>"   id="email" name="email" type="email" placeholder="Email "  class="form-control form-control-prepended" aria-describedby="description-profilename">
                                                    </div>
                                                    <small id="description-profileage" class="form-text text-muted">Email.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="list-group-item">
                                        <div role="group" aria-labelledby="label-adresse" class="m-0 form-group">
                                            <div class="form-row">
                                                <label id="adress" for="adresse" class="col-md-3 col-form-label form-label">Adresse</label>
                                                <div class="col-md-9">
                                                    <textarea id="adress" name="adress" placeholder="Votre adresse ..." rows="3" class="form-control"><?php echo e(old('adress')); ?></textarea>
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

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/c2mserver/public_html/caisse.gcmi.store/resources/views/Admin/Etudiant/add.blade.php ENDPATH**/ ?>