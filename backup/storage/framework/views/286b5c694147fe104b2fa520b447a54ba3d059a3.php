
<?php $__env->startSection('style'); ?>

<link href="<?php echo e(url('assets/libs/datatables/dataTables.bootstrap4.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('assets/libs/datatables/responsive.bootstrap4.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('assets/libs/datatables/buttons.bootstrap4.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('assets/libs/datatables/select.bootstrap4.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Header Layout Content -->
<!-- Header Layout Content -->

<div class="mdk-drawer-layout__content page ">
    <div class="container page__container">
        <br><br><br>
        <div class="card border-left-3 border-left-primary card-2by1 mt50">
            <div class="card-body">
                <div class="media flex-wrap align-items-center">
                    <div class="media-left col-md-9">
                        Importer les fichiers
                    </div>
                    
                </div>
            </div>
        </div>
        
        
        <div class="card">
            <div class="card-header">
               
              <div class="row">
                <div class="col-md-3 ">
                <h4 class="card-title" style="display: inline-block"> Importer les fichiers </h4>
                </div>
                <div class="col-md-3 ">
                    <a href="<?php echo e(url('example/example_pro.xlsx')); ?>" download="" class="btn btn-info">Exmaple produit</a>
                   
                </div> 
                <div class="col-md-3 ">
                    <a href="<?php echo e(url('example/example_class.xlsx')); ?>" download="" class="btn btn-info">Exmaple classe</a>
                   
                </div> 
                <div class="col-md-3 ">
                    <a href="<?php echo e(url('example/example_eleve.xlsx')); ?>" download="" class="btn btn-info">Exmaple Eleve</a>
                    </div>
                </div> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                         <?php if( Session::has('success') ): ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <strong><?php echo e(Session::get('success')); ?></strong>
                            </div>
                            <?php endif; ?>
                            <?php if( Session::has('error') ): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <strong><?php echo e(Session::get('error')); ?></strong>
                            </div>
                            <?php endif; ?>
                            <?php if(count($errors) > 0): ?>
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <div>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p><?php echo e($error); ?></p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div> 
                            <?php endif; ?>
                        <form action="<?php echo e(route('import.classes')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            
                            <div class="form-group row">
                                <label for="quiz_image" class="col-sm-3 col-form-label form-label">Importer les classes :</label>
                                <div class="col-sm-9 col-md-4">
                                    

                                     <input
                                            class="fileupload"
                                            type="file"
                                            name="file"
                                            id="file"
                                            style="position: absolute;  clip: rect(0px, 0px, 0px, 0px); ">
                                            <div class="bootstrap-filestyle input-group">
                                                <span class="group-span-filestyle input-group-btn" tabindex="0">
                                                    <label for="file" class="btn btn-default ">
                                                        
                                                        <span class="buttonText">Choisir un fichier</span>
                                                    </label>
                                                </span>
                                                <input type="text" class="form-control " placeholder="" disabled="">
                                                
                                            </div>
                                        
                                </div>
                                <div class="col-md-3 ">
                                    <button type="submit" class="btn btn-success">Importer</button>
                                </div>
                            </div>
                            
                        </form>
                        <form action="<?php echo e(route('import.produit')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group row">
                                <label for="quiz_image" class="col-sm-3 col-form-label form-label">Importer les produits :</label>
                                <div class="col-sm-9 col-md-4">
                                    
                                       <input
                                            class="fileupload"
                                            type="file"
                                            name="file_professeur"
                                            id="file_professeur"
                                            style="position: absolute;  clip: rect(0px, 0px, 0px, 0px); ">
                                            <div class="bootstrap-filestyle input-group">
                                                <span class="group-span-filestyle input-group-btn" tabindex="0">
                                                    <label for="file_professeur" class="btn btn-default ">
                                                        
                                                        <span class="buttonText">Choisir un fichier</span>
                                                    </label>
                                                </span>
                                                <input type="text" class="form-control " placeholder="" disabled="">
                                                
                                            </div>
                                        
                                </div>
                                <div class="col-md-3 ">
                                    <button type="submit" class="btn btn-success">Importer</button>
                                </div>
                            </div>
                            
                        </form>
                        <form action="<?php echo e(route('import.eleves')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group row">
                                <label for="quiz_image" class="col-sm-3 col-form-label form-label">Importer les élèves :</label>
                                <div class="col-sm-9 col-md-4">
                                        <input
                                            class="fileupload"
                                            type="file"
                                            name="file_eleve"
                                            id="file_eleve"
                                            style="position: absolute;  clip: rect(0px, 0px, 0px, 0px); ">
                                            <div class="bootstrap-filestyle input-group">
                                                <span class="group-span-filestyle input-group-btn" tabindex="0">
                                                    <label for="file_eleve" class="btn btn-default ">
                                                        
                                                        <span class="buttonText">Choisir un fichier</span>
                                                    </label>
                                                </span>
                                                <input type="text" class="form-control " placeholder="" disabled="">
                                                
                                            </div>
                                </div>
                                <div class="col-md-3 ">
                                    <button type="submit" class="btn btn-success">Importer</button>
                                </div>
                            </div>
                            
                            
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<!-- Required datatable js -->
<script src="<?php echo e(url('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<!-- Buttons examples -->
<script src="<?php echo e(url('assets/plugins/datatables/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/plugins/datatables/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/plugins/datatables/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/plugins/datatables/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(url('assets/plugins/datatables/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/plugins/datatables/buttons.print.min.js')); ?>"></script>
<script type="text/javascript">
$(function(){
'use strict';
$('#myTable').DataTable({
responsive: true,

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
<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-installations\xampp5.6\htdocs\pointvente.sys\resources\views/Admin/bascule/index.blade.php ENDPATH**/ ?>