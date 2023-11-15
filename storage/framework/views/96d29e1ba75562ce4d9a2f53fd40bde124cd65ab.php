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
                        Configuration point de vente :
                    </div>

                </div>
            </div>
        </div>


        <form action="<?php echo e(route("refresh-pv")); ?>" method="POST">

            <?php echo e(csrf_field()); ?>


             <div class="form-group" style="display: flex;">
                <button id="refresh-pv" class="btn btn-primary" style="margin: auto; margin-right: 1rem">Actualiser</button>
            </div>
        </form>

        <div class="card " style="padding: 1rem;">

            <form action="<?php echo e(route("save_config")); ?>" method="POST">

                <?php echo e(csrf_field()); ?>


                <div class="form-group">
                    <label for="">URL Parent : </label>
                    <input value="<?php echo e($config->url_parent ? $config->url_parent : ''); ?>" name="url_parent" id="parent_url" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label for=""> Instance : </label>
                    <select name="guid_depot" name="" class="form-control" id="depots_list">
                        <option value="">Selectionner ...</option>
                    </select>
                </div>
            </form>

            <div class="form-group" style="display: flex;">
                <button id=pv_config_submit class="btn btn-primary" style="margin: auto; margin-right: 1rem">Enregistrer</button>
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
    $(function() {
        'use strict';
        $('#myTable').DataTable({
            responsive: true,

        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        document.forms[0].addEventListener('submit', (e) => {
            e.preventDefault();
        });


        if (document.getElementById('parent_url').value != '') {
            console.log('already has config file ');
            let URL = $("#parent_url").val();
            $.ajax({
                type: "POST",
                url: URL + "/views/parametrage/pv_controller.php",
                data: {
                    act: "pv_client_list",
                    pwd: "8US64H%kMla6AqCVO9GkJZ%@5vb9"
                },
                // dataType: 'json', // what to expect back from the PHP script, if anything
                success: function(data) {

                    let depots = JSON.parse(data);

                    let depots_select = document.getElementById("depots_list");

                    depots_select.innerHTML = `\n<option value="">Selectionner ...</option>\n`

                    Array.from(depots).forEach(element => {
                        depots_select.innerHTML += `\n<option value="${element.pv_guid}">${element.nom}</option>\n`
                    });

                    document.getElementById('depots_list').value="<?php echo e($config->guid_depot); ?>";

                }
            });
        }

        $("#parent_url").keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                let URL = $("#parent_url").val();
                $.ajax({
                    type: "POST",
                    url: URL + "/views/parametrage/pv_controller.php",
                    data: {
                        act: "pv_client_list",
                        pwd: "8US64H%kMla6AqCVO9GkJZ%@5vb9"
                    },
                    // dataType: 'json', // what to expect back from the PHP script, if anything
                    success: function(data) {

                        let depots = JSON.parse(data);

                        let depots_select = document.getElementById("depots_list");

                        depots_select.innerHTML = `\n<option value="">Selectionner ...</option>\n`

                        Array.from(depots).forEach(element => {
                            depots_select.innerHTML += `\n<option value="${element.pv_guid}">${element.nom}</option>\n`
                        });

                    }
                });

            }

        })


        document.getElementById("pv_config_submit").addEventListener('click', () => {
            document.forms[1].submit();
        })
 document.getElementById("refresh-pv").addEventListener('click', () => {
            document.forms[0].submit();
        })

    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\caisse\resources\views/Admin/pv/index.blade.php ENDPATH**/ ?>