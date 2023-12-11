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
                                                <form method="" >
                                                     <?php echo e(csrf_field()); ?>

                                                <input type="hidden" id ="id_operationStock" name="id_operationStock" value="<?php echo e($id); ?>" >
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
                                                      <div class="form-group">
                                                        <label for="exampleInputqte">Date Operation</label>
                                                        <input type="date" class="form-control date_opt " value="<?php echo e(date('Y-m-d')); ?>" id="date_opt" placeholder="date Operation" name="date_opt" style="padding: 2em;">
                                                      </div>
                                                    
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                          <label for="exampleInputqte">Quantité</label>
                                                          <input type="number" class="form-control qte" id="exampleInputqte" placeholder="Quantité" name="qte" style="padding: 2em;" value="<?php echo e(old('qte')); ?>" step="any">
                                                        </div>
                                                        <div class="col-3">
                                                          <label for="exampleInputprix">Prix</label>
                                                          <input type="number" class="form-control prix" id="exampleInputprix" placeholder="prix" name="prix" style="padding: 2em;" value="<?php echo e(old('prixEntre')); ?>" step="any">
                                                        </div>
                                                         <div class="col-3 text-right">
                                                          <br>
                                                          <button type="button" class="btn btn-success   ajouter" >    <?php echo e(__('Ajouter')); ?></button>
                                                          <button type="button" class="btn btn-danger   supp" >    <?php echo e(__('Supprimer')); ?></button>
                                                      </div>
                                                      </div>   
                                                      <table id="operationTable" class="table table-striped table-bordered operationTable" cellspacing="0" width="100%">
                                                        <thead>
                                                        
                                                          <th id="Prod">Prod</th>
                                                          <th id="Qte">Quantité</th>
                                                          <th id="prix">Prix</th>
                                                        </thead>
                                                        <tbody id="operationTbody">
                                                          
                                                        </tbody>
                                                      </table>
                                                    <div class="form-group row mb-0">
                                                        <div class="col-sm-9 offset-sm-3">
                                                            <button type="submit" class="btn btn-success pull-right submit">Enregistrer</button>
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
 var table = $('#operationTable').DataTable({
          "searching": false,
           "paging": false,
          });
 $('.ajouter').click(function(){
            // var fournisseur = $("select.fournisseur option").filter(":selected").data('val');
            // var idfournisseur = $("select.fournisseur option").filter(":selected").val();
            var qte = $('.qte').val();
            var prixEntre = $('.prix').val();
            var idprod = $("select.prod option").filter(":selected").val();
            var prod = $("select.prod option").filter(":selected").data('val');

            var newRow = '<tr><td data-id="'+idprod+'" id="idprod">'+prod+'</td><td id="qte" data-qte="'+qte+'">'+qte+'</td><td id="prix" data-prix="'+prixEntre+'">'+prixEntre+'</td></tr>';
              table.row.add($(newRow)).draw();
          });

          $('#operationTable tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );
         
            $('.supp').click( function () {
                table.row('.selected').remove().draw( false );
            } );


            $('.submit').click(function(e){
              e.preventDefault() ; 
            var date_opt = $('#date_opt').val();
            var remarque = $('.remarque').val();
            console.log(remarque);
            var $table = $('.operationTable');
            var operation = [];
            // var columnNamesF = $table.find('thead th#fournisseur').map(function() {
            //     return $(this).text();
            // });
            var columnNamesP = $table.find('thead th#Prod').map(function() {
                return $(this).text();
            });
            var columnNamesQ = $table.find('thead th#Qte').map(function() {
                return $(this).text();
            });
            var columnNamesPR = $table.find('thead th#prix').map(function() {
                return $(this).text();
            });
            $table.find('tbody#operationTbody tr').each(function(){
                var rowValuesH = {};
                // $(this).find('td#idfournisseur').each(function(i) {
                //     rowValuesH[columnNamesF[i]] = $(this).data('id');
                // });
                $(this).find('td#idprod').each(function(i) {
                    rowValuesH[columnNamesP[i]] = $(this).data('id');
                    // rowValuesH[]
                });
                $(this).find('td#qte').each(function(i) {
                    rowValuesH[columnNamesQ[i]] = $(this).data('qte');
                });
                $(this).find('td#prix').each(function(i) {
                    rowValuesH[columnNamesPR[i]] = $(this).data('prix');
                });
                operation.push(rowValuesH);

            });
                 $.ajax({
                    url: "<?php echo e(route('admin.detail.stock.save')); ?>",
                    type: 'post', 
                    data: {
                      // id_frns : $('#fournisseur').val(),
                      id_operationStock :$('#id_operationStock').val() ,
                      operation:operation,
                      remarque:remarque,
                      date_opt:date_opt,
                      _token: '<?php echo csrf_token(); ?>',
                      },
                    success: function (data)
                    {
                      console.log(data);
                       location.reload();
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

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hp\Desktop\pointvente.sys\resources\views/Admin/stock/detail/add.blade.php ENDPATH**/ ?>