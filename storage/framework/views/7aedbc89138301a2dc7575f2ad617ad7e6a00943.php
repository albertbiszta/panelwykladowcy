<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                
             <div class="card-header">
                <a href="<?php echo e(route('groups.index')); ?>"> <i class="fas fa-long-arrow-alt-left fa-lg"></i> 
                </a>



                <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

            </div>

            <div class="card-header">

                <!-- Formularz -->
                <?php echo Form::open(['url'=>'groups', 'class' =>'form-horizontal']); ?>


                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        <?php echo Form::label('name','Nazwa:'); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::text('name',null,['class'=>'form-control']); ?>

                    </div>
                </div>

                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        <?php echo Form::label('year','Rok:'); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::text('year',null,['class'=>'form-control']); ?>

                    </div>
                </div>

                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        <?php echo Form::label('contact','Kontakt do przedstawiciela:'); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::text('contact',null,['class'=>'form-control']); ?>

                    </div>
                </div>




                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <?php echo Form::submit('Dodaj grupę',['class'=>'btn btn-primary']); ?>

                    </div>
                </div>







                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/groups/create.blade.php ENDPATH**/ ?>