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
                        Configuration Paramétrage Global De L'application :
                    </div>

                </div>
            </div>
        </div>



        <div class="card " style="padding: 1rem;">

            <form action="<?php echo e(route('save_params')); ?>" method="POST">

                <?php echo e(csrf_field()); ?>




                <div class="form-group">
                    <label for=""> Ticket Cuisine : </label>
                    <input <?php echo e($config->enable_cusisine == 1 ? 'checked' : ''); ?>  name="enable_cusisine" id="enable_cusisine" class="form-control" type="checkbox">
                </div>

                <div class="form-group">
                    <label for=""> Ticket Barman : </label>
                    <input <?php echo e($config->enable_barman == 1 ? 'checked' : ''); ?>  name="enable_barman" id="enable_barman" class="form-control" type="checkbox">
                </div>
                
                <div class="form-group">
                    <label for=""> Cloturage V1 (Liste les ventes) : </label>
                    <input <?php echo e($config->cloturage_v1 == 1 ? 'checked' : ''); ?>  name="cloturage_v1" id="cloturage_v1" class="form-control" type="checkbox">
                </div>

                                
                <div class="form-group">
                    <label for=""> Cloturage V2 (Montants seulement) : </label>
                    <input <?php echo e($config->cloturage_v2 == 1 ? 'checked' : ''); ?>  name="cloturage_v2" id="cloturage_v2" class="form-control" type="checkbox">
                </div>


              <div class="form-group">
                    <label for=""> Afficher la liste des table : </label>
                    <input <?php echo e($config->table_select == 1 ? 'checked' : ''); ?>  name="table_select" id="table_select" class="form-control" type="checkbox">
                </div>

                                
                <div class="form-group">
                    <label for=""> Afficher la liste des remarques : </label>
                    <input <?php echo e($config->remarque_select == 1 ? 'checked' : ''); ?>  name="remarque_select" id="remarque_select" class="form-control" type="checkbox">
                </div>


                <div class="form-group" style="display: flex;">
                    <button id=pv_config_submit class="btn btn-primary" type="submit" style="margin: auto; margin-right: 1rem">Enregistrer</button>
                </div>


                

            </form>


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
    $(function() {
        'use strict';
        $('#myTable').DataTable({
            responsive: true,

        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {


    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\caisse\resources\views/Admin/params/index.blade.php ENDPATH**/ ?>