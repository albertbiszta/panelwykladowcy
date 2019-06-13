<div>
	<?php $__env->startSection('content'); ?>
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="card"  style="width: 65rem;" >

				<div class="card-body">


					<div class="card-body">

						<?php if(Session::has('flash_message_error')): ?>
						<div class="alert alert-error alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button> 
							<strong><?php echo session('flash_message_error'); ?></strong>
						</div>
						<?php endif; ?>   
						<?php if(Session::has('flash_message_success')): ?>
						<div class="alert alert-success alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button> 
							<strong><?php echo session('flash_message_success'); ?></strong>
						</div>
						<?php endif; ?>

						<div>
							<div class="alert alert-success alert-block"  id="success-info" style="display: none">
								<button type="button" class="close" data-dismiss="alert" >×</button> 
								<strong>
									<p id="info">
									</p>
								</strong>
							</div>

						</div>




						<div class="float-right" > 
							<a class="btn btn-outline-secondary button-1" href="#" role="button" data-toggle="modal" data-target="#showSyllabus" aria-haspopup="true" aria-expanded="false">
								Wyświetl Syllabus
							</a>

							<a class="btn btn-outline-secondary button-1" id="open-assignGroup-modal" href="#" role="button" data-toggle="modal" data-target="#assignGroup" aria-haspopup="true" aria-expanded="false">
								Przypisz grupę do przedmiotu
							</a>



							<br> <br>

							

						</div>





						<?php if(count($subject->groups) > 0): ?>
						

						<table class="table table-bordered table-sm table-responsive-sm">
							<thead>
								<tr>
									<th scope="col">Nazwa </th>
									<th scope="col">Rok</th>
									<th scope="col">Lista studentów</th>
									<th scope="col">Oceny</th>
									<th scope="col">Zajęcia</th>

									<th scope="col"><i class="fas fa-cog fa-lg"></i>



									</th>

								</tr>
							</thead>
							<tbody id="groups-tbody">


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
											<i class="fas fa-user-graduate fa-lg" style="color: black"></i>

										</a>

									</td>
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

									<td>



										


										<input type="hidden" name="groupId" id="groupId" value="<?php echo e($group->id); ?>">
										<button type="submit" data-toggle="modal" data-target="#confirm-unassign" data-id="<?php echo e($group->id); ?>" 
											id="unassign-group" class="btn btn-light btn-sm">
											<i class="far fa-trash-alt fa-lg"></i>
										</button>






									</td>





								</tr>

								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							</tbody>
						</table>

						<?php else: ?>


		<h6><b> 
							<p>[ Nie dodałeś grup do tego przedmiotu ]</p>
					</b></h6>

					
					



					<?php endif; ?>

				</div>
				




			</div>
		</div>
	</div>


	<input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">

	<input type="hidden" name="subjectId" id="subjectId" value="<?php echo e($subject->id); ?>">




	

	<div class="modal fade" id="showSyllabus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title"><b>Syllabus:  </b> <?php echo e($subject->name); ?></h4>



					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<?php if($subject->syllabus): ?>

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

					<?php else: ?>
					<h6>  <b> Nie stworzyłeś jeszcze syllabusa do tego przedmiotu </b>  </h6>	
					<a href="<?php echo e(action('SyllabusController@create')); ?>" style="color: black"> 
						<b>  Dodaj syllabus</b>

					</a>
					<?php endif; ?>
				</div>


			</div>
		</div>
	</div>

	



	

	<?php echo Form::open(['route'=> ['subjects.assignGroup', $subject->id], 'class' =>'form-horizontal']); ?>



	<div class="modal fade" id="assignGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">Przypisz grupę do przedmiotu</h4>


					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<div  class="col-md-6">

							<select class="form-control" name="groups" id="groups">
								<option value="" disable="true" selected="true"> Wybierz grupę </option>
								<?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								<?php if(!$subject->groups->contains($key)): ?>

								<option value="<?php echo e($key); ?>"><?php echo e($value); ?> </option>

								<?php endif; ?>

								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>


						</div></div>



					</div>
					<div class="modal-footer">

						<div class="form-group">
							<div class="col-md-4 col-md-offset-4">
								<?php echo Form::submit('Dodaj grupę do przedmiotu',['class'=>'btn btn-outline-secondary button-1']); ?>

							</div>
						</div>

						

					</div>


					<?php echo Form::close(); ?>



				</div>
			</div>
		</div>

		


		


<?php if(count($subject->groups) > 0): ?>
		<div class="modal fade" id="confirm-unassign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<h4 class="modal-title">Czy na pewno chcesz usunąć grupę z przedmiotu?</h4>


						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<?php echo Form::open(['action'=> ['SubjectController@unassignGroup',
							$subject->id, $group->id],
							'method'=>'POST', 'class' =>'form-horizontal']); ?>



							<?php echo e(Form::hidden('_method', 'DELETE')); ?>

							<?php echo e(Form::button('Tak', [ 'type'=>'submit' , 'class' => 'btn btn-outline-danger float-right'])); ?>



							<?php echo Form::close(); ?>


							
						</div>

						
					</div>
				</div>
			</div>

		<?php endif; ?>	











		<?php $__env->stopSection(); ?></div>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/subjects/show.blade.php ENDPATH**/ ?>