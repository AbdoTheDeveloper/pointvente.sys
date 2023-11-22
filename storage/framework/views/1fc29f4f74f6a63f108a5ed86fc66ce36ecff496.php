<?php $__env->startSection('script'); ?>

<script type="text/javascript">
    $(document).on('keypress', 'form input[type="text"]', function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            if ($("#searched_value").is(":focus") && $("searched_value").val() != "") {
                let methode = $("#methode").val();
                let valeur = $("#searched_value").val();

                $.ajax({

                    url: "<?php echo e(route('admin.inventaire_get_data')); ?>",
                    method: 'POST',
                    data: {
                        methode: methode,
                        valeur: valeur,
                        _token: "<?php echo e(csrf_token()); ?>",

                    },
                    success: function(data) {
                        let prods = Array.from(JSON.parse(data));


                        let html_string = "";
                        prods.forEach(element => {
                            html_string += `<option data-qte="${element.qte}" value="${element.code_bar}"> ${element.lebelle} </option>`;
                        });

                        $("#prod_to_update").html(html_string);

                        $("#qte_actuel").val(prods[0].qte);

                        $("#nvl_qte").focus();

                    }
                });
            }



            if ($("#nvl_qte").is(":focus") && $("#nvl_qte").val() != "") {


                let valeur = $("#prod_to_update").val();
                let qte = $("#nvl_qte").val();

                $.ajax({

                    url: "<?php echo e(route('admin.inventaire_save_data')); ?>",
                    method: 'POST',
                    data: {
                        valeur: valeur,
                        nouvelle_qte: qte,
                        _token: "<?php echo e(csrf_token()); ?>",

                    },
                    success: function(data) {

                        console.log(data);
                    }
                });

                $("#methode").val("code_bar");
                $("#searched_value").val("");
                $("#searched_value").focus();

            }



        }
    });

    $("#prod_to_update").on("change", () => {

        $("#qte_actuel").val($("#prod_to_update").find(':selected').data('qte'));
        $("#nvl_qte").focus();

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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Inventaire De Stock</h4>
                        </div>
                        <div class="card-body">

                            <?php if($errors->any()): ?>
                            <div class="alert alert-danger alert-styled-left login-form">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li> <span class="text-semibold"> <?php echo e($error); ?></span></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php endif; ?>

                            <form method="POST" action="<?php echo e(route('admin.store_article')); ?>" enctype="multipart/form-data">
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

                                    <label for="quiz_title" class="col-sm-2 col-form-label form-label">Methode :</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="methode" id="methode">
                                            <option value="code_bar">Code Bar</option>
                                            <option value="nom">Lebelle</option>
                                        </select>
                                    </div>
                                    <label for="quiz_title" class="col-sm-2 col-form-label form-label">Valeur :</label>
                                    <div class="col-sm-4">
                                        <input id="searched_value" name="searched_value" type="text" class="form-control" placeholder="Valeur a rechercher">
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <label for="quiz_title" class="col-sm-2 col-form-label form-label">Produit :</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="prod_to_update" id="prod_to_update">
                                            <option value=""> AUCUN PRODUIT SELECTIONNES </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="quiz_title" class="col-sm-2 col-form-label form-label">QTE Actuel :</label>
                                    <div class="col-sm-4">
                                        <input id="qte_actuel" name="qte_actuel" type="text" class="form-control" placeholder="QTE Actuelle">

                                    </div>
                                    <label for="quiz_title" class="col-sm-2 col-form-label form-label">Nouvelle QTE :</label>
                                    <div class="col-sm-4">
                                        <input id="nvl_qte" name="nvl_qte" type="text" class="form-control" placeholder="Nouvelle QTE">
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
<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hp\Desktop\projects\caisse\caisse\resources\views/Admin/article/inventaire.blade.php ENDPATH**/ ?>