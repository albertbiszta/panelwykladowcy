<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
       <div class="card"  style="width: 65rem;" >
          
                <div class="card-header">Twoje przedmioty</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/panel.blade.php ENDPATH**/ ?>