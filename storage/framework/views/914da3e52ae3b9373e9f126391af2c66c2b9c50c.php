<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<i href="/subjects/create" class="fas fa-plus-circle fa-lg"></i>
					<a href="/subjects/create">Dodaj przedmiot 	</a>
				</div>

				<div class="card-body">
					<table class="table table-borderless">
						<thead>
							<tr>
								<th scope="col">Nazwa przedmiotu</th>
																<th scope="col">Punkty ECTS</th>
								<th scope="col">Egzamin</th>
								<th scope="col">Szczegóły / grupy</th>
								
								<th scope="col"><i class="fas fa-cog fa-lg"></i>



								</th>
								
							</tr>
						</thead>
						<tbody>

						
							<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
							<tr>
								<td> <?php echo e($subject->name); ?> </td>
								
								<td> <?php echo e($subject->ects); ?> </td>
								<td> 
									<?php if($subject->exam == 1): ?>
									Tak

									<?php else: ?>
									Nie

									<?php endif; ?>

								</td>

								<td>   <a href="<?php echo e(url('subjects', $subject->id)); ?>"> 
								
									<i class="far fa-list-alt fa-lg" style="color: black"></i>

								 </a></td>

								


								<td>
									
								<?php echo Form::open(['action'=> ['SubjectController@destroy', $subject->id],
												'method'=>'POST', 'class' =>'form-horizontal']); ?>

													<a href="<?php echo e(route('subjects.edit', $subject->id)); ?>" class="btn btn-light btn-sm"><i class="far fa-edit fa-lg"></i></a>

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/subjects/index.blade.php ENDPATH**/ ?>