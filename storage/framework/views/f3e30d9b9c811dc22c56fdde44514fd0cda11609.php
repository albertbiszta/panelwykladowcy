<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
             
               <div class="card-body"></div>

               <div class="card-body">
                <p id="p-center-big">  Zaloguj się  </p>    

            </div>

            <div class="card-body " id="login-form">
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="form-group row justify-content-center">
                      

                      <div class="col-md-6">
                        <input id="email" type="email" placeholder="E-Mail" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                        <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                 

                 <div class="col-md-6">
                    <input id="password" type="password" placeholder="Hasło" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required autocomplete="current-password">

                    <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
            </div>

            <div class="form-group row ">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                        <label class="form-check-label" for="remember">
                            <?php echo e(__('Zapamiętaj mnie')); ?>

                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">


                                    <p id="p-center">

                                     <button type="submit" class="btn btn-outline-secondary" id="button-1">
                                        <?php echo e(__('Zaloguj się')); ?>

                                    </button>
                                </p>


                            </div>
                        </div>

                    </form>
                    <div class="card-body">
                        <p id="p-center">
                            Nie masz konta?

                        </p>

                        <p id="p-center">
                            <b>   
                              <a href="<?php echo e(route('register')); ?>">
                                <?php echo e(__('Zarejestruj się')); ?>

                            </a> 
                        </b>



                    </p>



                </div>

            </div>
            



        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/auth/login.blade.php ENDPATH**/ ?>