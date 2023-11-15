   





        <!-- jQuery -->
    <script src="<?php echo e(url('assets/vendor/jquery.min.js')); ?>"></script>

    <!-- Bootstrap -->
    <script src="<?php echo e(url('assets/vendor/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/vendor/bootstrap.min.js')); ?>"></script>

    <!-- Perfect Scrollbar -->
    <script src="<?php echo e(url('assets/vendor/perfect-scrollbar.min.js')); ?>"></script>

    <!-- MDK -->
    <script src="<?php echo e(url('assets/vendor/dom-factory.js')); ?>"></script>
    <script src="<?php echo e(url('assets/vendor/material-design-kit.js')); ?>"></script>

    <!-- App JS -->
    <script src="<?php echo e(url('assets/js/app.js')); ?>"></script>

    <!-- Highlight.js -->
    <script src="<?php echo e(url('assets/js/hljs.js')); ?>"></script>

    <!-- App Settings (safe to remove) -->
    <script src="<?php echo e(url('assets/js/app-settings.js')); ?>"></script>

    <!-- Global Settings -->
    <script src="<?php echo e(url('assets/js/settings.js')); ?>"></script>

    <!-- Moment.js -->
    <script src="<?php echo e(url('assets/vendor/moment.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/vendor/moment-range.min.js')); ?>"></script>

    <!-- Chart.js -->
    <script src="<?php echo e(url('assets/vendor/Chart.min.js')); ?>"></script>

    <!-- UI Charts Page JS -->
    <script src="<?php echo e(url('assets/js/chartjs-rounded-bar.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/chartjs.js')); ?>"></script>

    <script src="<?php echo e(url('assets/js/select2.full.js')); ?>"></script>

    <!-- Chart.js Samples -->
    <script src="<?php echo e(url('assets/js/page.student-dashboard.js')); ?>"></script>



    <script type="text/javascript">
    
        $( document ).ready(function() {
    
$(".select2-single").select2({
            theme: "bootstrap",
            placeholder: "",
            maximumSelectionSize: 6,
            containerCssClass: ":all:"
        });

    });


</script>

			<?php echo $__env->yieldContent('script'); ?><?php /**PATH C:\Users\hp\Desktop\projects\caisse\caisse\resources\views/Inc/admin/script.blade.php ENDPATH**/ ?>