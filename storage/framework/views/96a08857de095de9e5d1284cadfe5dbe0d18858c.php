<?php $__env->startSection('content'); ?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">
				<?php echo e($group->name); ?>

				</div>

				<div class="card-header">
					
					<a href="<?php echo e(route('addStudent', $group->id)); ?>"> <i class="fas fa-plus-circle fa-lg"></i> 
					Dodaj studentów </a>
				</div>

				<div class="card-body">
					<table class="table table-borderless">
						<thead>
							<tr>
								<th scope="col">Nazwisko</th>
								<th scope="col">Imię</th>
								<th scope="col">Numer indeksu</th>
								<th scope="col">Kontakt</th>
								<th scope="col"><i class="fas fa-cog fa-lg"></i>
								


								</th>
								
							</tr>
						</thead>
						<tbody>


							<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							<tr>
								<td> <?php echo e($student->lastname); ?> </td>
								<td> <?php echo e($student->firstname); ?> </td>
								<td> <?php echo e($student->indexNumber); ?> </td>
								<td> <?php echo e($student->contact); ?> </td>
								

								<td>
							
									
								</td>

								<td>


									<?php echo Form::open(['action'=> ['StudentController@destroy', $student->id],
									'method'=>'POST', 'class' =>'form-horizontal']); ?>

									<a href="<?php echo e(route('students.edit', $student->id)); ?>" class="btn btn-light btn-sm"><i class="far fa-edit fa-lg"></i></a>

									<?php echo e(Form::hidden('_method', 'DELETE')); ?>

									<?php echo e(Form::button('<i class="far fa-trash-alt fa-lg"></i>', [ 'type'=>'submit' , 'class' => 'btn btn-light btn-sm'])); ?>



									<?php echo Form::close(); ?>				







									
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/groups/show.blade.php ENDPATH**/ ?>