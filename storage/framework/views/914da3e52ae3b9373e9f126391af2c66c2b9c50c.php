<?php $__env->startSection('content'); ?>



<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<b>  
						<a href=""  id="newSubject" class="float-right" style="color: black" data-toggle="modal" data-target="#addSubject">
							<i class="fas fa-plus-circle fa-lg"></i> Dodaj przedmiot 	</a>
						</b>

					</div>

					<div class="card-body">
						<div>
							<div class="alert alert-success alert-block"  id="success-info" style="display: none">
								<button type="button" class="close" data-dismiss="alert" >×</button> 
								<strong>
									<p id="info">
									</p>
								</strong>
							</div>

						</div>
						

						<table class="table table-bordered table-sm table-responsive-sm">
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
						<tbody id="subjects-tbody">



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

									<a href="" data-toggle="modal" data-target="#editSubject" data-id="<?php echo e($subject->id); ?>" 
										data-name="<?php echo e($subject->name); ?>" data-ects="<?php echo e($subject->ects); ?>" data-exam="<?php echo e($subject->exam); ?>" 
										class="btn btn-light btn-sm edit-subject">
										<i class="far fa-edit fa-lg"></i>
									</a>



									<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="<?php echo e($subject->id); ?>" id="delete-subject" class="btn btn-light btn-sm button-1">
										<i class="far fa-trash-alt fa-lg"></i>
									</button>






								</td>




							</tr>


							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</tbody>
					</table>

				</div>

				
				<div class="modal fade" id="addSubject" tabindex="-1" role="dialog" data-dismiss="modal" aria-label="Close">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Dodaj nowy przedmiot</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"><span >&times;</span></button>

							</div>


							<div class="modal-body">
								<div class="alert alert-danger alert-block"  id="validation-info" style="display:none">

								</div>

				
									<div class="form-group">
										<div  class="col-md-4 control-label">
											<?php echo Form::label('name','Nazwa:'); ?>

										</div>
										<div class="col-md-6">
											<?php echo Form::text('name',null,['class'=>'form-control', 'id'=>'name']); ?>

										</div>
									</div>

									<div class="form-group">
										<div  class="col-md-4 control-label">
											<?php echo Form::label('ects','Punkty ECTS:'); ?>

										</div>
										<div class="col-md-6">
											<?php echo Form::text('ects',null,['class'=>'form-control', 'id'=>'ects']); ?>

										</div>
									</div>


									<div class="form-group">
										<div  class="col-md-4 control-label">
											<?php echo Form::label('exam','Egzamin'); ?>

										</div>
										<div class="col-md-6">

											<select class="form-control" name="exam" id="exam" >
												<option value="0" disable="true" selected="true"> Nie </option>
												<option value="1"> Tak </option>
											</select>
										</div>
									</div>


								</div>
								<div class="modal-footer">
									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-outline-secondary button-1" 
											id="submitSubject">Dodaj przedmiot</button>
										
											</div>
										</div>
									</div>


								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->

						



						

						<div class="modal fade" id="editSubject" tabindex="-1" role="dialog" data-dismiss="modal" aria-label="Close">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"> Edytuj przedmiot</h4>
		
								<button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"><span >&times;</span></button>

							</div>


							<div class="modal-body">
								<div class="alert alert-danger alert-block"  id="validation-edit" style="display:none">

								</div>
										<div class="form-group">
											<div  class="col-md-4 control-label">
												<?php echo Form::label('nameEdit','Nazwa:'); ?>

											</div>
											<div class="col-md-6">
												<input type="text" class="form-control" name="name" id="nameEdit">

											</div>
										</div>

										<div class="form-group">
											<div  class="col-md-4 control-label">
												<?php echo Form::label('ectEdits','Punkty ECTS:'); ?>

											</div>
											<div class="col-md-6">
												<input type="text" class="form-control" name="ects" id="ectsEdit">
											</div>
										</div>


										<div class="form-group">
											<div  class="col-md-4 control-label">
												<?php echo Form::label('examEdit','Egzamin'); ?>

											</div>
											<div class="col-md-6">

												<select class="form-control" name="exam" id="examEdit" >
													<option value="0" disable="true" selected="true"> Nie </option>
													<option value="1"> Tak </option>
												</select>
											</div>
										</div>


									</div>
									<div class="modal-footer">
										<div class="form-group">
											<div class="col-md-6 col-md-offset-4">
												<button type="submit" class="btn btn-outline-secondary button-1"
												id="submitEditSubject">
												Zapisz zmainy
											</button>
											
										</div>
									</div>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->

					





					

					<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">

								<div class="modal-header">
									<h4 class="modal-title">Czy na pewno chcesz usunąć ten przedmiot?</h4>


									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<button type="button" id="confirm-delete-subject" class="btn btn-outline-danger float-right"
									data-dismiss="modal">Tak</button>
								</div>


							</div>
						</div>
					</div>

					


				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">

	<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/subjects/index.blade.php ENDPATH**/ ?>