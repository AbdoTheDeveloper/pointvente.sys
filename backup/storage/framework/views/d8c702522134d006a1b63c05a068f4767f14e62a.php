<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="ltr">
    
    <head>
        <?php echo $__env->make('Inc.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body class=" layout-fluid">
        
        <!-- Header Layout -->
        <div class="mdk-header-layout js-mdk-header-layout">
           
            <div class="mdk-header-layout__content">
                <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
                        <div class="mdk-drawer-layout__content page ">

                            
                            <?php echo $__env->yieldContent('content'); ?>
                                
                           


                </div>
                  
                    
                </div>

            </div>
            
        </div>
        
        <?php echo $__env->make('Inc.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html><?php /**PATH D:\xampp-installation\xampp-5.6\htdocs\pointvente.sys\resources\views/Trav/main.blade.php ENDPATH**/ ?>