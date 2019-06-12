<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
     <div class="card"  style="width: 65rem;" >

        <div class="card-header"><b> Twoje przedmioty </b></div>

        <div class="card-body">
            <?php if(session('status')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session('status')); ?>

            </div>
            <?php endif; ?>

            <div class="card-body">

              <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(count($subject->groups) > 0): ?>


             <h6><b> <u> 
                 <a href="<?php echo e(url('subjects', $subject->id)); ?>" style="color: black"> 
                    <?php echo e($subject->name); ?>


                </a>
             </u>
            </b></h6>


        <table class="table table-bordered table-sm table-responsive-sm">
            <thead>
                <tr>
                    <th scope="col">Nazwa grupy</th>
                    <th scope="col">Rok</th>
                    <th scope="col">Lista studentów</th>
                    <th scope="col">Oceny</th>
                    <th scope="col">Zajęcia</th>


                </th>

            </tr>
        </thead>
        <tbody>


            <?php $__currentLoopData = $subject->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>

                <td> 
                    <a href="<?php echo e(url('groups', $group->id)); ?>" style="color: black"> 
                        <?php echo e($group->name); ?>


                    </a>

                </td>


                <td> <?php echo e($group->year); ?> </td>
                <td>    <a href="<?php echo e(url('groups', $group->id)); ?>" > 

                    <i class="fas fa-user-graduate fa-lg" style="color: black"></i>

                </a></td>
                <td> 
                    <a href="<?php echo e(action('GradeController@groupGrades', [$subject->id, $group->id])); ?>" style="color: black"> 
                      <i class="far fa-file-alt fa-lg" style="color: black"></i>

                  </a>



              </td>
              <td> 
                <a href="<?php echo e(action('LessonController@groupLessons', [$subject->id, $group->id])); ?>" style="color: black"> 
                  <i class="fas fa-chalkboard" style="color: black"></i>

              </a>

          </td>




      </tr>


      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </tbody>
</table>



<br>

<?php else: ?>
   
              <h6><b> <u> 
                 <a href="<?php echo e(url('subjects', $subject->id)); ?>" style="color: black"> 
                    <?php echo e($subject->name); ?>


                </a>
             </u>
            </b></h6>
           
            <p>[ Nie dodałeś grup do tego przedmiotu ]</p>

<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>













</div>


</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/panel.blade.php ENDPATH**/ ?>