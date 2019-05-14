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

                <?php echo Form::model($student, ['method'=>'PATCH','class'=>'form-horizontal',
                'action'=>['StudentController@update', $student->id]]); ?>


                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        <?php echo Form::label('firstname','Imię:'); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::text('firstname',null,['class'=>'form-control']); ?>

                    </div>
                </div>

                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        <?php echo Form::label('lastname','Nazwisko:'); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::text('lastname',null,['class'=>'form-control']); ?>

                    </div>
                </div>


                <div class="form-group">
                    <div  class="col-md-4 control-label">
                      <?php echo Form::label('group_id','Grupa:'); ?>

                  </div>
                  <div class="col-md-6">
    

                        <select class="form-control" name="group_id" id="exampleFormControlSelect2">
                        <option value="" disable="true" selected="true"> Wybierz grupę </option>
                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?> </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>


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
                    <?php echo Form::submit('Zapisz zmiany',['class'=>'btn btn-primary']); ?>

                </div>
            </div>







            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/students/edit.blade.php ENDPATH**/ ?>