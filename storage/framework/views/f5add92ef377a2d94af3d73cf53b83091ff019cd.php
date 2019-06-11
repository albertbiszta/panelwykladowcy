<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
               <div class="card-body">
                <p id="p-center-big">  Zarejestruj się  </p>    

            </div>


                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row justify-content-center">
                        

                            <div class="col-md-6">
                                <input id="name"  placeholder="Imię i Nazwisko " type="text" class="form-control <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>

                                <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?>
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
                                <input id="university"  placeholder="Uczelnia" type="text" class="form-control <?php if ($errors->has('university')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('university'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="university" value="<?php echo e(old('university')); ?>" required autocomplete="university" autofocus>

                                <?php if ($errors->has('university')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('university'); ?>
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
                                <input id="email" placeholder="E-Mail" ype="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">

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
                                <input id="password"  placeholder="Hasło" type="password" class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required autocomplete="new-password">

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

                        <div class="form-group row justify-content-center">
                       

                            <div class="col-md-6">
                                <input id="password-confirm" placeholder="Powtórz hasło" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                     <br>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6">

                                    <p id="p-center">

                                     <button type="submit" class="btn btn-outline-secondary" id="button-1">
                                        <?php echo e(__('Zarejestruj się')); ?>

                                    </button>
                                </p>
                    
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <p id="p-center">
                            Posiadasz już konto?

                        </p>

                        <p id="p-center">
                            <b>   
                              <a href="<?php echo e(route('login')); ?>">
                                <?php echo e(__('Zaloguj się')); ?>

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

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/auth/register.blade.php ENDPATH**/ ?>