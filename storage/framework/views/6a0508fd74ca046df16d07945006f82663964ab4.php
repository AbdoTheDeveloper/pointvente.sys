<?php $__env->startSection('style'); ?>
<link href="<?php echo e(url('assets/plugins/sweet-alert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('assets/plugins/sweet-alert2/sweetalert2.min.js')); ?>"></script>

    <script type="text/javascript">
    $(".editClassementByCat1").on("click",function() {

        var idcat1 = $(this).attr("val");
        var classement_value = $("#idcat1"+idcat1).val();
        var idcat_sm_niveau4= idcat1;
        var token = $("input[name='_token']").val();

        $.ajax({
        url: "<?php echo route('editClassementNiveau') ?>",
        method: 'POST',
        data: {idcat1:idcat1,
              classementcat1:classement_value,
             _token: token},
        success: function(data) 
        {


console.log(data);
            /*if(data=="")
            {
             swal({                         
             title: "success!",
             text: "Classement produit par niveau 4 effectue !!",
             button: "ok!",
             timer: 2500,
             type: "success",
             confirmButtonColor: "#4fa7f3"
             }); 
            }*/
            var res = data.split(";");
            if(res[0]=="error")
            {
                swal({                         
                 title: "erreur!",
                 text: res[1],
                 button: "ok!",
                 timer: 2500,
                 type: "danger",
                 confirmButtonColor: "#4fa7f3"
                 }); 
            }
            if(res[0]=="success")
            {
                 swal({                         
                 title: "success!",
                 text: "Classement modifier avec succée",
                 button: "ok!",
                 timer: 2500,
                 type: "success",
                 confirmButtonColor: "#4fa7f3"
                 }); 
            }

        }
        });
         return false;
    });
</script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
      <!-- Header Layout Content -->
         <!-- Header Layout Content -->
        
                <div class="mdk-drawer-layout__content page ">
  <?php echo e(csrf_field()); ?>

                    <div class="container page__container">
                            <br><br><br>
                            <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                <div class="card-body">
                                    <div class="media flex-wrap align-items-center">
                                        <div class="media-left col-md-9">
                                            Listes des niveaux
                                        </div>
                                        <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                            <a class="btn btn-success pull-right" href="<?php echo e(route('AddNiveau')); ?>"> <i class="fa fa-plus"></i>&nbsp;Ajouter niveau</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h1 class="h2">Gérer les niveaux</h1>
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
                                                            <th>Niveau</th>
                                                            <th>Classement</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list" id="search">


                                                        <?php $__currentLoopData = $niveaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $niveau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                                                        <tr>

                                                                
                                                            <td>

                                                                <span class="js-lists-values-employee-name"><?php echo e($niveau->Desc_niveau); ?></span>

                                                            </td>
                                                                    
                                                            <td width="23%">
                          
                                                              <form class="form-inline ">
                                                                  
                                                                  
                                                                  <div class="form-group col-md-8">
                                                                    <input type="text"  class="form-control" id="idcat1<?php echo e($niveau->id); ?>" name="classement_cat1" value="<?php echo e($niveau->classement); ?>">
                                                                  </div>

                                                                  
                                                                  <button type="button" class="btn btn-primary btn-sm editClassementByCat1 col-md-3" val="<?php echo e($niveau->id); ?>" > <i class="material-icons">edit</i> </button>

                                                                </form>
                                                                
                                                            </td>

                                                            <td>
                                                                <div class="button-list">
                                                                   <a href="<?php echo e(route('deleteNiveau',["id"=>$niveau->id])); ?>" class="btn btn-danger btn-sm">
                                                                        <i class="material-icons">close</i>
                                                                    </a>
                                                                   
                                                                    
                                                                    <a href="<?php echo e(route('editNiveau',["id"=>$niveau->id])); ?>" type="button" class="btn btn-warning btn-sm">
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
   




    <script type="text/javascript">
          $(function(){
        'use strict';

         $('#myTable').DataTable({
          responsive: true,
           
         });
      });
    </script>






<?php $__env->stopSection(); ?>



<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/c2mserver/public_html/caisse.gcmi.store/resources/views/Admin/Niveau/index.blade.php ENDPATH**/ ?>