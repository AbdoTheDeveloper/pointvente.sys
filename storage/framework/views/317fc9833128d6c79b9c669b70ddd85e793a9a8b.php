<meta charset="UTF-8">

<?php ($recttotal = 0); ?>
<?php ($test = 0); ?>




  

        <table class="fl-table" border="1">
            <thead>
                <tr style="background: #049B1D;text-align: center;" >
                    <th colspan="2" style="text-align: center;font-size:20px"> Date  </th>
                    <th colspan="2" style="text-align: center;font-size:20px">N° Ticket  </th>
                    <th colspan="2" style="text-align: center;font-size:20px"> Article</th>
                    <th style="text-align: center;font-size:20px"> Qte</th>
                    <th style="text-align: center;font-size:20px"> P.U</th>
                    <th style="text-align: center;font-size:20px">Mode d'encaissement</th>
                    <th colspan="3"> Remise</th>
                    <th colspan="3"> Montant</th>
                </tr>
            </thead>
            <tbody class="list" id="search">
                <?php $__currentLoopData = $cloturages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Cloturage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php ($recttotal += $Cloturage->montant); ?>
                <?php $__currentLoopData = $Cloturage->operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $operation->DetailOperations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php ($test +=  (!empty($operation->remise) && $operation->remise >0)?($detail->prix) - (($detail->prix)*$operation->remise/100): $detail->prix); ?>
                    <tr>
                        <td colspan="2"><?php echo e($operation->created_at); ?></td>
                        <td colspan="2"> <?php echo e($operation->numtick); ?> </td>
                        <?php ($arti = $detail->article); ?>
                        <?php ( $lebelle = $arti ? $arti->lebelle : ''); ?>
                        <td colspan="2"> <?php echo e($lebelle); ?>  </td>
                        <td> <?php echo e($detail->qte_prod); ?>  </td>
                        <td> <?php echo e($detail->prix); ?>  </td>
                        <td style="text-align: center;"> <?php echo e($Cloturage->modeCaisse); ?>  </td>
                        <td colspan="3" style="text-align: right;">  <?php echo e((!empty($operation->remise) && $operation->remise >0)?($operation->remise/100) :"Non Remise"); ?>  </td>
                        <td colspan="3" style="text-align: right;">  <?php echo e((!empty($operation->remise) && $operation->remise >0)?($detail->prix) - (($detail->prix)*$operation->remise/100) .' DH': $detail->prix.' DH'); ?>  </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
	
        


        

	



<?php /**PATH E:\wamp64\www\caisse\resources\views/Admin/recette/excel.blade.php ENDPATH**/ ?>