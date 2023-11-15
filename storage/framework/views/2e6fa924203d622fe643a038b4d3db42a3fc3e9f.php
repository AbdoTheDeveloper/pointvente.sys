<!DOCTYPE html>
<html lang="en" dir="ltr">
 
    <head>
        <?php echo $__env->make('Inc.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
        <body class="login">
            <div class="d-flex align-items-center" style="min-height: 100vh ;  background: url(<?php echo e(url('assets/images/back.jpg')); ?>);background-position: center;
            background-size: 100%;
            background-repeat: no-repeat;">
                <div class="col-sm-8 col-md-8 col-lg-8 mx-auto" style="min-width: 300px;">
                    <div class="card navbar-shadow">
                        
                        <div class="card-body">
                          
                            <div class="page-separator">
                                <div class="page-separator__text"> <?php echo $__env->yieldContent('espace'); ?></div>
                            </div>

                            <?php echo $__env->yieldContent('content'); ?>
                            
                        </div>
                        <div class="card-footer text-center text-black-50">
                           
                                <?php if(Route::has('password.request')): ?>
                                    <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('Mot de passe oublié?')); ?>

                                    </a>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
          
            
            <?php echo $__env->make('Inc.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </body>
        </html><?php /**PATH C:\Users\hp\Desktop\projects\caisse\caisse\resources\views/auth/main.blade.php ENDPATH**/ ?>