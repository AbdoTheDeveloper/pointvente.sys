<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="ltr">
    
    <head>
       <?php echo $__env->make('Inc.admin.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>

<body class=" layout-fluid">

    <div class="preloader">
        <div class="sk-double-bounce">
            <div class="sk-child sk-double-bounce1"></div>
            <div class="sk-child sk-double-bounce2"></div>
        </div>
    </div>


      <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">


        <?php echo $__env->make('Admin.inc.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
         <div class="mdk-header-layout__content">
        <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
        <?php echo $__env->yieldContent('content'); ?>
       
        <?php echo $__env->make('Admin.inc.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
            </div>
        </div>
        
        <?php echo $__env->make('Inc.admin.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH E:\wamp64\www\caisse\resources\views/Admin/main.blade.php ENDPATH**/ ?>