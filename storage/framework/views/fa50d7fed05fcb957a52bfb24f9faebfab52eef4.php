


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
                            <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                <div class="card-body">
                                    <div class="media flex-wrap align-items-center">
                                        <div class="media-left col-md-9">
                                            Detail des stocks
                                        </div>
                                        <div class="media-right  col-md-3 mt-2 mt-xs-plus-0 ">
                                            <a class="btn btn-success pull-right" href="<?php echo e(route('admin.detail.stock.add',['id'=>$id])); ?>"> <i class="fa fa-plus"></i>&nbsp;Ajouter Un stock</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h1 class="h2">Detail des stocks</h1>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                            <?php if(Session::has('message')): ?>
                                          <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>
                                          <?php endif; ?>
                                          <?php if(session('success')): ?>
                                          <div class="alert alert-success border-1 border-left-3 border-left-success d-flex alert-dismissible">
                                              
                                              <i class="material-icons text-success mr-3">check_circle</i>
                                              <div class="text-body"><?php echo e(session('success')); ?></div>
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <?php endif; ?>
                                          <?php if(session('error') ): ?>
                                          <div class="alert alert-danger alert-styled-left login-form">
                                              <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                          class="sr-only">Close</span></button>
                                          <span class="text-semibold"> <?php echo e(session('error')); ?></span>
                                          </div>
                                          <?php endif; ?>
                  
                  
                                          
                  
                                          <div class="row">							
                                          <div class="col-12">
                                              <table class="table text-center tableClick">
                                                  <thead class=" text-primary">
                                                    <th>Code Bar</th>
                                                      <th>Produit</th>
                                                      <th>Type</th>
                                                      <th>Quantité</th>
                                                      <th>Prix</th>
                                                      <th></th>
                                                  </thead>
                                                  <tbody id="stock">
                                                      <?php $__currentLoopData = $prods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                          <tr>
                                                              <td><?php echo e($item->code_bar); ?></td>
                                                              <td><?php echo e($item->lebelle); ?></td>
                                                              <td><?php
                                                                  if($item->type==1)
                                                                 echo  "Local";
                                                                  elseif ($item->type==0) {
                                                                    echo "Externe";
                                                                  }
                                                                  else {
                                                                    echo  "Charge";
                                                                  }
                                                                  
                                                                  ?></td>
                                                              <td><?php echo e($item->qteEntrer); ?></td>
                                                              <td><?php echo e($item->prixEntre); ?></td>
                                                              <td>
                                                                <a  href="<?php echo e(route('admin.detail.stock.delete',["id"=>$item->iddetail])); ?>" onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément');" class="btn btn-danger btn-sm">
                                                                    <i class="material-icons">close</i>
                                                                </a>
                                                            

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
<script src="<?php echo e(url('assets/plugins/sweet-alert2/sweetalert2.min.js')); ?>"></script>

<script>
	$(document).ready(function() {


		var dateD=0;
		var dateF=0;

		 $(".date").on('change',function(){

	     dateD = $('[name=dateD]').val()
	     dateF = $('[name=dateF]').val()

	     $.ajax({
	            url: "<?php echo e(route('admin.StockOperationGet')); ?>",
	            type: 'get', 
	            data: {dateD:dateD,
	            		dateF:dateF},
	            success: function (data)
	            {
                   
                    console.log(data)
						$('#stock').html(data);
					

	            },
	            error: function (values)
	            {
                    console.log(values)
	            	swal("il y a un problem technique...", "error");
	            }
	        }); 
		});



	   
	} );
</script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-installations\xampp5.6\htdocs\pointvente.sys\resources\views/Admin/stock/detail/index.blade.php ENDPATH**/ ?>