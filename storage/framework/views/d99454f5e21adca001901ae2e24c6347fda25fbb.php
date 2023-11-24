
<?php $__env->startSection('espaceimg',url('assets/images/pro/ad.png')); ?>
<?php $__env->startSection('espace',"Espace Administrateur"); ?>
<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('admin.ShowLogin')); ?>">
   <?php echo csrf_field(); ?>
    <div class="form-group">
        <label class="form-label" for="email">Email:</label>
        <div class="input-group input-group-merge">
            <input id="email" type="email" required="" name="email" class="form-control form-control-prepended <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('E-Mail Address')); ?>"  value="<?php echo e(old('email')); ?>" required autofocus>
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-envelope"></span>
                </div>
            </div>
            <?php if($errors->has('email')): ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('email')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Mot de passe:</label>
        <div class="input-group input-group-merge">
            <input id="password" type="password" required="" class="form-control form-control-prepended <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Mot de passe')); ?>"  name="password" required />
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
            <?php if($errors->has('password')): ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('password')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
    </div>
    <div class="custom-control custom-checkbox">
        <input id="terms" class="custom-control-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
        <label for="terms" class="custom-control-label text-black-70">
            <?php echo e(__('Enregistrer mon compte')); ?>

        </label>
    </div>
    <div class=" text-right">
                                    <a href="<?php echo e(route('admin.password.request')); ?>">
                                        Mot de passe oublié ?
                                    </a>
                                </div>
    <br>

      
    <div class="form-group ">
        <button type="submit" class="btn btn-primary btn-block">    <?php echo e(__('Connecter')); ?></button>
    </div>

</form>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('auth.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Rapport_Projets\pointvente.sys\resources\views/Admin/auth/login.blade.php ENDPATH**/ ?>