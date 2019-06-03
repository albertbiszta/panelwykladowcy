<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header">


    <?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

                <!-- Formularz -->
                <?php echo Form::open(['url'=>'subjects', 'class' =>'form-horizontal']); ?>


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
                        <?php echo Form::label('ects','Punkty ECTS:'); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::text('ects',null,['class'=>'form-control']); ?>

                    </div>
                </div>


                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        <?php echo Form::label('exam','Egzamin'); ?>

                    </div>
                    <div class="col-md-6">

                        <?php echo Form::select('exam',[null=>'Wybierz'] + $exam);; ?>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <?php echo Form::submit('Dodaj przedmiot',['class'=>'btn btn-secondary']); ?>

                    </div>
                </div>







                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/subjects/create.blade.php ENDPATH**/ ?>