
<?php if(!empty($classes)): ?>
  <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  	<option value="<?php echo e($key); ?>"> <?php echo e($value); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH D:\xampp-installations\xampp5.6\htdocs\pointvente.sys\resources\views/Admin/Etudiant/ajax-niveau-calsses.blade.php ENDPATH**/ ?>