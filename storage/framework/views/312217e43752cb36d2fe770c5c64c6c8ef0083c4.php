<?php $__env->startSection('style'); ?>
<link href="<?php echo e(url('assets/plugins/sweet-alert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>
      <!-- Header Layout Content -->
         <!-- Header Layout Content -->
        
                <div class="mdk-drawer-layout__content page ">
                    <?php echo e(csrf_field()); ?>

                    <div class="container page__container">
                            <br><br><br>
                            

                            <h1 class="h2">Gérer les Cloturages</h1>
                            <div class="card">
                                <div class="card-body">

                                    <form target="_blank" action="<?php echo e(route('admin.listRecette')); ?>" id="addform" method="post" name="form_warenbewegungen" enctype="multipart/form-data">
               
                                      <?php echo csrf_field(); ?> 

                                      <div class="row">
                                         
                                              <div class="form-group col-6 offset-md-3">
                                                <label for="exampleInputName1">Nom travailleur</label>
                                                <select class="form-control select2-single   id_trav" data-select2-id="1" tabindex="-1" aria-hidden="true" name="id_trav" id="id_trav">
                                                    <option value="0" selected="selected">------</option>
                                                  <?php $__currentLoopData = $travailleurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $travailleur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($travailleur->id); ?>"><?php echo e($travailleur->nom); ?></option>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </select>
                                              </div>
                  
                                             
                                                  <div class="form-group col-6 offset-md-3">
                                                      <label for="exampleInputqte">date Début</label>
                                                      <input value="<?php echo e(date('Y-m-d')); ?>" type="date" class="form-control id_trav dateD" id="exampleInputqte" placeholder="date Debut" name="dateD" style="padding: 2em;">
                                                    </div>
                                                    <div class="form-group col-6 offset-md-3">
                                                      <label for="exampleInputqte">date Fin</label>
                                                      <input value="<?php echo e(date('Y-m-d')); ?>" type="date" class="form-control id_trav dateF" id="exampleInputqte" placeholder="date fi" name="dateF" style="padding: 2em;">
                                                    </div>
                                        </div>
                                        <div class="offset-md-3 text-zero">
                                            <button type="submit" class="btn btn-primary btn-lg  mr-1 ">Imprimer</button>
                                            <button type="button" id="exportexcel" class="text-right btn btn-success btn-lg  mr-1 ">Export Excel</button>
                                     
                                          </div>
                                         
                                        </form>
                                    </div>

                                </div>
                            </div>
                    </div>

                  
                  
                
<?php $__env->stopSection(); ?>




<?php $__env->startSection('script'); ?>


<script>

$("#exportexcel" ).on( "click", function( event ) {
            
         
         var form = $( "#addform" );
         var datafrom = new FormData(document.getElementById("addform"))
         $.ajax({
            type: "POST",
            url: "<?php echo e(route('admin.recette.export.excel')); ?>",
            data: datafrom,
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
            

                var blob=new Blob([data]);
            var link=document.createElement('a');
            link.href=window.URL.createObjectURL(blob);
            link.download="Recette_<?php echo date('Y-m-d') ?>.xls";
            link.click();
            $( ".loadingex" ).hide();      
                     
                                          
            }
        });
       
        });
  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hp\Desktop\projects\caisse\caisse\resources\views/Admin/recette/index.blade.php ENDPATH**/ ?>