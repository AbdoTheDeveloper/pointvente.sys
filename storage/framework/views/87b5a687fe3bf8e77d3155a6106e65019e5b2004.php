
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
                        Liste des ventes a synchromiser :
                    </div>

                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                            <table class="table table-centered table-bordered table-bordred table-striped" id="myTable">
                                <thead>
                                    <tr>

                                        <th class="nowrap"> <input id="select_all_details" type="checkbox" /> </th>
                                        <th class="nowrap">ID</th>
                                        <th class="nowrap">Designation</th>
                                        <th class="nowrap">Categorie</th>
                                        <th class="nowrap">QTE</th>
                                        <th class="nowrap">Prix</th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="search">


                                    <?php $__currentLoopData = $ventes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td><input data-id="<?php echo e($vente->id_detail); ?>" class="select_detail" id="select_detail_<?php echo e($vente->id_detail); ?>" type="checkbox" /></td>
                                        <td><?php echo e($vente->id_vente); ?></td>
                                        <td><?php echo e($vente->designation); ?></td>
                                        <td><?php echo e($vente->nom); ?></td>
                                        <td><?php echo e($vente->qte_vendu); ?></td>
                                        <td><?php echo e($vente->prix_produit); ?></td>
                                    </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>



           <form action="<?php echo e(route("fusionner-pv")); ?>" method="POST">

            <?php echo e(csrf_field()); ?>


            <input hidden name="liste_ventes" value="<?php echo e(json_encode($unique_ventes)); ?>" />
            <input hidden id="selected_details" name ="selected_details" value=""/>

            <div class="form-group" style="display: flex;">
                <?php if($unique_ventes): ?>
                <button id="refresh-pv" class="btn btn-primary" style="margin: auto; margin-right: 1rem">Fusionner </button>
                <?php endif; ?>
            </div>
        </form>


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
   // document.getElementById("pv_config_submit").addEventListener('click', () => {
     //   document.forms[1].submit();
    //})

    let selected_details = [];

    document.getElementById("refresh-pv").addEventListener('click', () => {
    document.forms[0].submit();
    })

      $("#select_all_details").on('click',function(){

        if(!$(this).is(':checked')){
        let allInputs = document.getElementsByTagName("input");
for (var i = 0, max = allInputs.length; i < max; i++){
    if (allInputs[i].type === 'checkbox')
        allInputs[i].checked = false;
}
        }
        else{
        let allInputs = document.getElementsByTagName("input");
for (var i = 0, max = allInputs.length; i < max; i++){
    if (allInputs[i].type === 'checkbox')
        allInputs[i].checked = true;
}
        }

        
      });



    $(".select_detail").on('click',function(){
      selected_details.push($(this).data('id'));
      document.getElementById("selected_details").value = JSON.stringify(selected_details);
    });


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp-installations\xampp5.6\htdocs\pointvente.sys\resources\views/Admin/pv/vente-liste.blade.php ENDPATH**/ ?>