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
                                            Liste des Categories
                                        </div>
                                        <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                            <a class="btn btn-success pull-right" href="<?php echo e(route('admin.create_cat')); ?>"> <i class="fa fa-plus"></i>&nbsp;Ajouter Categorie</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h1 class="h2">Gérer les Categories</h1>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                       
                                        <div class="col-lg-12">

                                            <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                                               
                                                <?php if(session('message')): ?>
                                                    <div class="alert alert-success">
                                                        <?php echo e(session('message')); ?>

                                                    </div>
                                                <?php endif; ?>
                                                
                                                <table class="table table-centered table-bordered table-striped" id="myTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Categorie</th>  
                                                            <th>Type</th>
                                                            
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list" id="search">

                                                        <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td>
                                                                <p><img alt=" <?php echo e(utf8_decode($cat->nom_cat)); ?> " src="<?php echo e(url('images/cat/'.$cat->img)); ?>"   width="150" class="rounded">
                                                                    <?php echo e($cat->nom_cat); ?>

                                                                </p>
                                                               
                                                            </td>  
                                                            <td>

                                                                <span class="js-lists-values-employee-name"><?php echo e($cat->type); ?></span>

                                                            </td>
                                                                    
                                                            
                                                            <td>
                                                                <div class="button-list">
                                                                    <a href="<?php echo e(route('admin.delete_cat',["id"=>$cat->id])); ?>"  onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément');" class="btn btn-danger btn-sm">
                                                                        <i class="material-icons">close</i>
                                                                    </a>
                                                                   
                                                                    
                                                                    <a href="<?php echo e(route('admin.edit_cat',["id"=>$cat->id])); ?>" type="button" class="btn btn-warning btn-sm">
                                                                        <i class="material-icons">edit</i>
                                                                    </a>

                                                                    
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                        

                                                        

                                                    </tbody>
                                                </table>
                                            </div>





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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/c2mserver/public_html/caisse.gcmi.store/resources/views/Admin/cat/index_cat.blade.php ENDPATH**/ ?>