<div class="list-group" id="list-tab" role="tablist">
						
						<?php $__currentLoopData = $optsCoutn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a class="cursorpointer list-group-item list-group-item-action pausedtickbtn" data-dismiss="modal" 
						 role="tab" 
						  data-idopt="<?php echo e($item->id); ?>">
						  <?php echo e($item->numtick); ?> - <?php echo e($item->created_at); ?> <?php echo e($item->nom ? '- Table : '.$item->nom : ' '); ?>

						
					        </a>
							
					
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div><?php /**PATH C:\Users\hp\Desktop\projects\caisse.gcmi.store\resources\views/Trav/ajax/getpausedtickets.blade.php ENDPATH**/ ?>