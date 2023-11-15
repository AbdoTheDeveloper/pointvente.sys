<?php $__currentLoopData = $prods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



<div class="col-md-2 " >
    <button class="artLInk click_btn <?php echo e(fmod($key,2) == 0 ? 'btn-primary' : 'btn-success'); ?>" style="width: 100%;min-height: 4rem;display: flex; align-items: center;justify-content: center;flex-direction: column; margin-bottom: .5rem"
    data-id="<?php echo e($item->id); ?>" data-prix="<?php echo e($item->prix_vente); ?>"
    data-art="<?php echo e($item->lebelle); ?>"
    data-unite="<?php echo e($item->unite); ?>"
    data-code="<?php echo e($item->code_bar); ?>"
    data-qte="<?php echo e($item->qte); ?>"
    data-remise-max="<?php echo e($item->remise_max); ?>"
    data-type="<?php echo e($item->type); ?>"
    style="color: black;padding-bottom: 3px !important;cursor: pointer;">
<!-- <img  width="120" height="120" src="<?php echo e(url('images/pro/'.$item->img)); ?>" > -->

    <b><?php echo e($item->lebelle); ?></b>
    <!-- <br><b>Quantité stock : </b>  <?php echo e($item->qte); ?> / <?php echo e($item->unite); ?> -->
    <div><b>Prix : </b> <?php echo e($item->prix_vente); ?></div>


</button>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\Users\hp\Desktop\projects\caisse\caisse\resources\views/Trav/article/withimg.blade.php ENDPATH**/ ?>