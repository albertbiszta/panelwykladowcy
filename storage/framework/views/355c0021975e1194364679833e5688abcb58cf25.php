<?php $__env->startSection('content'); ?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-body">





</div>

<div class="card-body">

	<!-- Formularz -->

	<?php echo Form::open(['route'=> ['subjects.assignGroup', $subject->id], 'class' =>'form-horizontal']); ?>




	<div class="form-group">
		<div  class="col-md-4">

			<select class="form-control" name="groups" id="exampleFormControlSelect2">
				<option value="" disable="true" selected="true"> Wybierz grupę </option>
				<?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<?php if(!$subject->groups->contains($key)): ?>

				<option value="<?php echo e($key); ?>"><?php echo e($value); ?> </option>
				
				<?php endif; ?>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>


		</div>

		
		

	</div>

	<div class="form-group">
		<div class="col-md-4 col-md-offset-4">
			<?php echo Form::submit('Dodaj grupę do przedmiotu',['class'=>'btn btn-primary']); ?>

		</div>
	</div>







	<?php echo Form::close(); ?>






</div>





<div class="card-body">
	<table class="table table-borderless">
		<thead>
			<tr>
				<th scope="col">Nazwa</th>
				<th scope="col">Rok</th>

				<th scope="col"><i class="fas fa-cog fa-lg"></i>



				</th>

			</tr>
		</thead>
		<tbody>


			<?php $__currentLoopData = $subject->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			<tr>
				<td> <?php echo e($group->name); ?> </td>


				<td> <?php echo e($group->year); ?> </td>

				<td>



					<?php echo Form::open(['action'=> ['SubjectController@unassignGroup',
						$subject->id, $group->id],
						'method'=>'POST', 'class' =>'form-horizontal']); ?>



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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/subjects/show.blade.php ENDPATH**/ ?>