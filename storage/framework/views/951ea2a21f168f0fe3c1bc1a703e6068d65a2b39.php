<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

             <div class="card-header">

                <a href="<?php echo e(route('groups.show', $group->id)); ?>"> <i class="fas fa-long-arrow-alt-left fa-lg"></i> 
                Wróć do grupy </a>
            </div>

            <div class="card-header">
                <?php echo Form::open(['route' => 'students.store']); ?>


                <?php echo Form::hidden('group_id', $group->id); ?>



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
                        <?php echo Form::label('indexNumber','Numer indeksu:'); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::text('indexNumber',null,['class'=>'form-control']); ?>

                    </div>
                </div>

                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        <?php echo Form::label('contact','Kontakt:'); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::text('contact',null,['class'=>'form-control']); ?>

                    </div>
                </div>



                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <?php echo Form::submit('Dodaj studenta',['class'=>'btn btn-primary']); ?>

                    </div>
                </div>


                <?php echo Form::close(); ?>




            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/students/create.blade.php ENDPATH**/ ?>