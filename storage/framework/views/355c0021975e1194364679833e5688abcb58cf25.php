<div>
	<?php $__env->startSection('content'); ?>
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="card"  style="width: 65rem;" >

				<div class="card-body">
					<ul class="nav nav-tabs">

						<li class="nav-item dropdown"  style="width: 60rem;">
							<a class="btn btn-outline-secondary btn-lg btn-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Wyświetl Syllabus
							</a>

							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">


								<a class="dropdown-item" href="#" style="width: 60rem;">

									<p>	<b>Język prowadzenia: </b> <?php echo e($subject->syllabus->language); ?>  </p>
									<p>	<b>Punkty ECTS: </b> <?php echo e($subject->ects); ?>  </p>
									<p>	<b>Przedmiot kończy się egzaminem: </b> 

										<?php if($subject->exam == 1): ?>
										Tak

										<?php else: ?>
										Nie

										<?php endif; ?>

									</p>


									<p>  <b>Opis: </b>  <?php echo e($subject->syllabus->description); ?> </p>

									

									<p> <b>Literaura: </b> <?php echo e($subject->syllabus->literature); ?>   </p>


								</a>




							</li>
						</ul>



					</div>






					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th scope="col">Nazwa</th>
									<th scope="col">Rok</th>
									<th scope="col">Lista studentów</th>
									<th scope="col">Oceny</th>

									<th scope="col"><i class="fas fa-cog fa-lg"></i>



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
									<td> 
										<a href="<?php echo e(url('groups', $group->id)); ?>" style="color: black"> 
											IKONA

										</a>

									</td>
									<td> 
										<a href="<?php echo e(action('GradeController@groupGrades', [$subject->id, $group->id])); ?>" style="color: black"> 
											IKONA

										</a>

									</td>


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
						<div class="card-header">

						</div>

						<div class="card-body">
							<h6><b>Przypisz grupę do przedmiotu: </b></h6>

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


								</div></div>

								<div class="form-group">
									<div class="col-md-4 col-md-offset-4">
										<?php echo Form::submit('Dodaj grupę do przedmiotu',['class'=>'btn btn-secondary']); ?>

									</div>
								</div>







								<?php echo Form::close(); ?>








							</div>




						</div>
					</div>
				</div>



			<?php $__env->stopSection(); ?></div>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/subjects/show.blade.php ENDPATH**/ ?>