
<?php $__env->startSection('script'); ?>
<script type="text/javascript">

    $( document ).ready(function() {



  $(".fileupload" ).on( "change", function( event ) {

                $(this).next().children(".form-control").val($(this).val().replace(/.*[\/\\]/, ''));
});


});


$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
  if(e.keyCode == 13) {
    e.preventDefault();
    return false;
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
      <!-- Header Layout Content -->
         <!-- Header Layout Content -->
         <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

                <div class="mdk-drawer-layout__content page ">

                    <div class="container-fluid page__container">


                            <br><br>

                             <div class="container page__container p-0">
                                <div class="row m-0">
                                    <div class="col-lg container-fluid page__container">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                            <li class="breadcrumb-item active">Ajouter article</li>
                                        </ol>
                                        <h1 class="h2">Ajouter une nouveau produit</h1>

                                        <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                            <div class="card-body">
                                                <div class="media flex-wrap align-items-center">
                                                    <div class="media-left col-md-8">
                                                        Ajouter une nouveau produit
                                                    </div>
                                                    <div class="media-right  col-md-4 mt-2 mt-xs-plus-0 ">
                                                        <a class="btn btn-success pull-right" href="<?php echo e(route('admin.index_article')); ?> "> <i class="fa fa-list"></i>&nbsp;Tous les articles</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Nouveau article</h4>
                                            </div>
                                            <div class="card-body">

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

                                                <form method="POST" action="<?php echo e(route('admin.store_article')); ?>" enctype="multipart/form-data"   >
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




                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Image :</label>
                                                        <div class="col-sm-9">

                                                                     <input
                                            class="fileupload"
                                            type="file"
                                            name="img"
                                            id="img"
                                            style="position: absolute;  clip: rect(0px, 0px, 0px, 0px); ">
                                            <div class="bootstrap-filestyle input-group">
                                                <span class="group-span-filestyle input-group-btn" tabindex="0">
                                                    <label for="img" class="btn btn-default ">

                                                        <span class="buttonText">Image article</span>
                                                    </label>
                                                </span>
                                                <input type="text" class="form-control " placeholder="" disabled="">

                                            </div>
                                                                </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Categorie article:</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2-single  " name="id_cat" id="id_cat">
                                                                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php if(Request::old('id_cat')==$cat->id){echo "selected";} ?>  value="<?php echo e($cat->id); ?>"><?php echo e($cat->nom_cat); ?></option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </select>
                                                            </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Unite article:</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2-single  " name="unite" id="unite">

                                                                <option <?php if(Request::old('unite')=="qte"){echo "selected";} ?>  value="qte">Quantité</option>
                                                                <option <?php if(Request::old('unite')=="kg"){echo "selected";} ?>  value="kg">KG</option>
                                                                <option <?php if(Request::old('unite')=="g"){echo "selected";} ?>  value="g">G</option>

                                                                 </select>
                                                            </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">lebelle article :</label>
                                                        <div class="col-sm-9">
                                                            <input id="lebelle" value="<?php echo e(Request::old('lebelle')); ?>" name="lebelle" type="text" class="form-control" placeholder="lebelle article" >
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Code bar article :</label>
                                                        <div class="col-sm-9">
                                                            <input id="code_bar" value="<?php echo e(Request::old('code_bar')); ?>" name="code_bar" type="text" class="form-control" placeholder="Code bar article" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">type article:</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control select2-single  " name="type" id="type">

                                                                <option <?php if(Request::old('type')=="1"){echo "selected";} ?>  value="1">Local</option>
                                                                <option <?php if(Request::old('type')=="0"){echo "selected";} ?>  value="0">Externe</option>
                                                                <option <?php if(Request::old('type')=="2"){echo "selected";} ?>  value="2">Charge</option>
                                                                <option <?php if(Request::old('type')=="3"){echo "selected";} ?>  value="3">Bar</option>

                                                                 </select>
                                                            </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Prix Achat :</label>
                                                        <div class="col-sm-9">
                                                            <input id="prix_achat" value="<?php echo e(Request::old('prix_achat')); ?>" name="prix_achat" type="text" class="form-control" placeholder="prix achat article" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Prix vente  :</label>
                                                        <div class="col-sm-9">
                                                            <input id="prix_vente" value="<?php echo e(Request::old('prix_vente')); ?>" name="prix_vente" type="text" class="form-control" placeholder="prix vente article" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="quiz_title" class="col-sm-3 col-form-label form-label">Quantité alerte :</label>
                                                        <div class="col-sm-9">
                                                            <input id="qte_alert" value="<?php echo e(Request::old('qte_alert')); ?>" name="qte_alert" type="text" class="form-control" placeholder="Quantité alerte" >
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

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-installations\xampp5.6\htdocs\pointvente.sys\resources\views/Admin/article/add.blade.php ENDPATH**/ ?>