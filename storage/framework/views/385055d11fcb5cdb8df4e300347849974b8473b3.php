<!DOCTYPE html>
<html lang="en" dir="ltr">
    
    <head>
        <?php echo $__env->make('Inc.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body class="login" >
        <div class="d-flex align-items-center" style="min-height: 100vh; background: url(<?php echo e(url('assets/images/back.jpg')); ?>);background-position: center;
        background-size: 100%;
        background-repeat: no-repeat;">
            <div class="col-sm-8 col-md-8 col-lg-8 mx-auto" style="min-width: 300px;">
                <div class="card navbar-shadow">
                    <div class="card-header text-center">
                        <img src="<?php echo e(url('assets/images/logo.png')); ?>" width="200">
                    </div>
                    <div class="card-body">
                        <div class="row">


                            
                            <div class="col-md-6">
                                <div  class="text-center">
                                   <a href="<?php echo e(route('admin.login')); ?>">
                                    <img src="<?php echo e(url('assets/images/pro/ad.png')); ?>"  width="40%"  >
                                    <br>
                                    <div class="page-separator__text"> Espace Administrateur</div>
                                    </a>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div  class="text-center">
                             <a href="<?php echo e(route('trav.login')); ?>">
                                    <img src="<?php echo e(url('assets/images/pro/pa.png')); ?>"  width="40%"  >
                                    <br>
                                    <div class="page-separator__text"> Espace Travailleurs </div>
                                </a>
                                </div>
                                
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <?php echo $__env->make('Inc.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html><?php /**PATH C:\Users\hp\Desktop\pointvente.sys\resources\views/welcome.blade.php ENDPATH**/ ?>