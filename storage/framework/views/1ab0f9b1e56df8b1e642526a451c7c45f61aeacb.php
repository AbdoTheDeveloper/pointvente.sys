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
                                            <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                            <li class="breadcrumb-item active">Ajouter produit</li>
                                        </ol>
                                        <h1 class="h2">Ajouter un nouveau produit</h1>

                                        <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                            <div class="card-body">
                                                <div class="media flex-wrap align-items-center">
                                                    <div class="media-left col-md-8">
                                                        Ajouter un nouveau produit 
                                                    </div>
                                                    <div class="media-right  col-md-4 mt-2 mt-xs-plus-0 ">
                                                        <a class="btn btn-success pull-right" href="<?php echo e(route('admin.detail.stock.index',['id' =>$id ])); ?> "> <i class="fa fa-list"></i>&nbsp;Tous les niveaux</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Nouveau niveau</h4>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" action="<?php echo e(route('admin.detail.stock.save')); ?>">
                                                     <?php echo e(csrf_field()); ?>

                                                <input type="hidden" name="id_operationStock" value="<?php echo e($id); ?>" >

                                                     <div class="form-group">
                                                        <label for="exampleInputName1">Categorie</label>
                                                        <select class="form-control select2-single   select2-single cat" data-select2-id="1" tabindex="-1" aria-hidden="true" name="id_cat" id="id_cat">
                                                          <option value="0">-----------</option>
                                                          <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->nom_cat); ?></option>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                      </select>
                                                      </div>

                                                      <div class="form-group">
                                                        <label for="exampleInputName1">Produits</label>
                                                        <select class="form-control select2-single   select2-single prod" data-select2-id="1" tabindex="-1" aria-hidden="true" name="id_prod" id="prod">
                                                        </select>
                                                      </div>
                                                      
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                        <label for="exampleInputqte">Quantité</label>
                                                        <input type="number" class="form-control qte" id="exampleInputqte" placeholder="Quantité" name="qte" style="padding: 2em;" value="<?php echo e(old('prix')); ?>" step="any">
                                                        </div>
                                                        <div class="col-6">
                                                        <label for="exampleInputprix">Prix</label>
                                                        <input type="number" class="form-control prixEntre" id="exampleInputprix" placeholder="prix" name="prix" style="padding: 2em;" value="<?php echo e(old('prix')); ?>" step="any">
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
<br><br><br><br><br><br><br><br><br>
                            <?php echo $__env->make('Admin.inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>


                </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url('assets/plugins/sweet-alert2/sweetalert2.min.js')); ?>"></script>

<script src="<?php echo e(url('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script>
  $(document).ready(function() {
$('.cat').change(function(){
    idcat = $("select#id_cat option").filter(":selected").val();


    $.ajax({
            url: "<?php echo e(route('admin.get_articles_stock')); ?>",
            type: 'get',
            dataType: "json",
            data: {id:idcat},
            success: function (data)
            {
                console.log(data);
                $('#prod').empty();
                $.each(data.prods, function(key,value) {
                  $('#prod').append('<option value="'+value.id+'" data-val="'+value.lebelle+'">'+value.lebelle+' ('+value.code_bar+') </option>');
                });
            },
            error: function (values)
            {
              console.log('il y a un problem technique...');
            }
        });
 });

 
});
</script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\caisse\resources\views/Admin/stock/detail/add.blade.php ENDPATH**/ ?>