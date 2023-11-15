<?php $__env->startSection('style'); ?>
    <link type="text/css" href="<?php echo e(url('assets/css/dashbord.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>
      <!-- Header Layout Content -->
         <!-- Header Layout Content -->

                <div class="mdk-drawer-layout__content page ">

                    <div class="container page__container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Administration</a></li>
                            <li class="breadcrumb-item active">Tableau de bord</li>
                        </ol>
                        <h1 class="h2">Tableau de bord d'administration</h1>





                                <div class="row">


                                    <div class="col-md-4">
                                      <div class="card-counter danger">
                                        <i class="fa fa-users"></i>
                                        <span class="count-numbers"><?php echo e($eleves); ?></span>
                                        <span class="count-name">Clients</span>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card-counter primary">
                                          <i class="fa fa-users"></i>
                                          <span class="count-numbers"><?php echo e($niveaus); ?></span>
                                          <span class="count-name">Articles</span>
                                        </div>
                                      </div>

                                    <div class="col-md-4">
                                      <div class="card-counter success">
                                        <i class="fa fa-building"></i>
                                        <span class="count-numbers"><?php echo e($classes); ?></span>
                                        <span class="count-name">Travailleurs</span>
                                      </div>
                                    </div>

                                </div>








                                <br>


                                <br>
                                <div class="row">
                                    <div class="col-lg-12">
                                         <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                              <div class="card-body">
                                                <h3 class="h2">Stock alerts</h3>
                                                <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                                                    <?php if(session('message')): ?>
                                                        <div class="alert alert-success">
                                                            <?php echo e(session('message')); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                    <table class="table table-centered table-bordered table-striped" id="myTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Code bar</th>
                                                                <th>Lebelle</th>
                                                                <th>QTE Restante</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="list" id="search">


                                                            <?php $__currentLoopData = $classes_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                                                            <tr>

                                                            
                                                                <td>

                                                                    <span class="js-lists-values-employee-name"><?php echo e($classe->code_bar); ?></span>

                                                                </td>

                                                                 <td>

                                                                    <span class="js-lists-values-employee-name"><?php echo e($classe->lebelle); ?></span>

                                                                </td>

                                                                 <td>

                                                                    <span class="js-lists-values-employee-name"><?php echo e($classe->qte); ?></span>

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


                                 <div class="row">

                                        <div class="col-lg-12">
                                             <div class="card border-left-3 border-left-primary card-2by1 mt50">
                                                  <div class="card-body">
                                                    <h3 class="h2">Derniers Clients ajoutés</h3>
                                                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>


                                                            <table class="table table-centered table-bordered table-striped" id="myTable">
                                                    <thead>
                                                        <tr>
                                                            <th>élève</th>
                                                            <th>Date naissance</th>
                                                            <th>Email</th>
                                                            <th>Adresse</th>
                                                            <th>Tel</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list" id="search">

                        <?php $__currentLoopData = $eleves_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eleve): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                            <td>

                                <span class="js-lists-values-employee-name"><?php echo e($eleve->nom." ".$eleve->prenom); ?>


                                 </span>

                            </td>
                            <td><small class="text-muted"><?php echo e(date('d-m-Y', strtotime($eleve->age))); ?></small></td>

                            <td>

                                <span class="js-lists-values-employee-name"><?php echo e($eleve->email); ?></span>

                            </td>

                            <td><small class="text-muted"><?php echo e($eleve->adress); ?></small></td>

                            <td><small class="text-muted"><?php echo e($eleve->tele); ?></small></td>

                            <td>
                                                                <div class="button-list">
                                                                   <a  href="<?php echo e(route('deleteEtudiant',["id"=>$eleve->id])); ?>"  class="btn btn-danger btn-sm">
                                                                        <i class="material-icons">close</i>
                                                                    </a>

                                                                     <a href="<?php echo e(route('editEtudiant',["id"=>$eleve->id])); ?>" type="button" class="btn btn-warning btn-sm">
                                                                        <i class="material-icons">edit</i>
                                                                    </a>


                                                                </div>
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

<?php echo $__env->make('Admin.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hp\Desktop\projects\caisse\caisse\resources\views/Admin/index.blade.php ENDPATH**/ ?>