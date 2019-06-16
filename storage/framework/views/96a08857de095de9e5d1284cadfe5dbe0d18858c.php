<?php $__env->startSection('content'); ?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">
					<h5 id="group-header">
						<b> <?php echo e($group->name); ?> </b>   
						<div class="float-right">

							
							<a href="" data-toggle="modal" data-target="#editGroup" data-id="<?php echo e($group->id); ?>" 
								data-name="<?php echo e($group->name); ?>" data-year="<?php echo e($group->year); ?>" data-contact="<?php echo e($group->contact); ?>" 
								class="btn btn-light btn-sm edit-group"><i class="far fa-edit fa-lg"></i>
								Edytuj grupę
							</a>




							</div>

						</h5>  	
					</div>

					<div class="card-header">

						<b>  
							<a href=""  id="newStudent" class="float-right" style="color: black" data-toggle="modal" data-target="#addStudent">
								<i class="fas fa-plus-circle fa-lg"></i> Dodaj studentów 	</a>
							</b>
							<br> 
							<input type="hidden" name="groupId" id="groupId" value="<?php echo e($group->id); ?>">

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
											<th scope="col">Nazwisko</th>
											<th scope="col">Imię</th>
											<th scope="col">Numer indeksu</th>
											<th scope="col">Kontakt</th>
											<th scope="col"><i class="fas fa-cog fa-lg"></i>



											</th>

										</tr>
									</thead>
									<tbody id="students-tbody">


										<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										<tr>
											<td> <?php echo e($student->lastname); ?> </td>
											<td> <?php echo e($student->firstname); ?> </td>
											<td> <?php echo e($student->indexNumber); ?> </td>
											<td> <?php echo e($student->contact); ?> </td>





											<td>



												<a href="" data-toggle="modal" data-target="#editStudent" data-id="<?php echo e($student->id); ?>" 
													data-firstname="<?php echo e($student->firstname); ?>" data-lastname="<?php echo e($student->lastname); ?>"
													data-indexNumber="<?php echo e($student->indexNumber); ?>" 
													data-contact="<?php echo e($student->contact); ?>" 
													class="btn btn-light btn-sm edit-student"><i class="far fa-edit fa-lg"></i></a>

													<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="<?php echo e($student->id); ?>" id="delete-student" class="btn btn-light btn-sm">
														<i class="far fa-trash-alt fa-lg"></i>
													</button>





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


				
				<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" data-dismiss="modal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Dodaj studenta</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

							</div>
							<div class="modal-body">
								<?php echo Form::hidden('group_id', $group->id); ?>



								<div class="form-group">
									<div  class="col-md-4 control-label">
										<?php echo Form::label('firstname','Imię:'); ?>

									</div>
									<div class="col-md-6">
										<?php echo Form::text('firstname',null,['class'=>'form-control', 'id'=>'firstname']); ?>

									</div>
								</div>


								<div class="form-group">
									<div  class="col-md-4 control-label">
										<?php echo Form::label('lastname','Nazwisko:'); ?>

									</div>
									<div class="col-md-6">
										<?php echo Form::text('lastname',null,['class'=>'form-control', 'id'=>'lastname']); ?>

									</div>
								</div>

								<div class="form-group">
									<div  class="col-md-4 control-label">
										<?php echo Form::label('indexNumber','Numer indeksu:'); ?>

									</div>
									<div class="col-md-6">
										<?php echo Form::text('indexNumber',null,['class'=>'form-control', 'id'=>'indexNumber']); ?>

									</div>
								</div>

								<div class="form-group">
									<div  class="col-md-4 control-label">
										<?php echo Form::label('contact','Kontakt:'); ?>

									</div>
									<div class="col-md-6">
										<?php echo Form::text('contact',null,['class'=>'form-control', 'id'=>'contact']); ?>

									</div>
								</div>





							</div>
							<div class="modal-footer">
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<?php echo Form::submit('Dodaj studenta',['class'=>'btn btn-outline-secondary button-1', 'id'=>"submitStudent"
											,
											'data-dismiss'=>'modal']); ?>

										</div>
									</div>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->



					
					<div class="modal fade" id="editStudent" tabindex="-1" role="dialog" data-dismiss="modal">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Zaktualizuj dane studenta</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

								</div>
								<div class="modal-body">
									<?php echo Form::hidden('group_id', $group->id); ?>



									<div class="form-group">
										<div  class="col-md-4 control-label">
											<?php echo Form::label('firstnameEdit','Imię:'); ?>

										</div>
										<div class="col-md-6">

											<?php echo Form::text('firstnameEdit',null,['class'=>'form-control', 'id'=>'firstnameEdit']); ?>

										</div>
									</div>


									<div class="form-group">
										<div  class="col-md-4 control-label">
											<?php echo Form::label('lastnameEdit','Nazwisko:'); ?>

										</div>
										<div class="col-md-6">
											<?php echo Form::text('lastnameEdit',null,['class'=>'form-control', 'id'=>'lastnameEdit']); ?>

										</div>
									</div>

									<div class="form-group">
										<div  class="col-md-4 control-label">
											<?php echo Form::label('indexNumberEdit','Numer indeksu:'); ?>

										</div>
										<div class="col-md-6">
											<?php echo Form::text('indexNumberEdit',null,['class'=>'form-control', 'id'=>'indexNumberEdit']); ?>

										</div>
									</div>

									<div class="form-group">
										<div  class="col-md-4 control-label">
											<?php echo Form::label('contactEdit','Kontakt:'); ?>

										</div>
										<div class="col-md-6">
											<?php echo Form::text('contactEdit',null,['class'=>'form-control', 'id'=>'contactEdit']); ?>

										</div>
									</div>





								</div>
								<div class="modal-footer">
									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<?php echo Form::submit('Zapisz zmiany',['class'=>'btn btn-outline-secondary button-1', 'id'=>"submitEditStudent"
												,
												'data-dismiss'=>'modal']); ?>

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
										<h4 class="modal-title">Czy na pewno chcesz usunąć studenta?</h4>


										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<button type="button" id="confirm-delete-student" class="btn btn-outline-danger float-right"
										data-dismiss="modal">Tak</button>
									</div>


								</div>
							</div>
						</div>

						


		
		<div class="modal fade" id="editGroup" tabindex="-1" role="dialog" data-dismiss="modal" aria-label="Close">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Edytuj grupę</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>


					<div class="modal-body float-center">

								<div class="alert alert-danger alert-block"  id="validation-edit" style="display:none">

								</div>

						<div class="form-group">
							<div class="col-md-8">
								<input type="text" id="nameEdit"  class="form-control" >
							</div>	
						</div>

						<div class="form-group">
							<div class="col-md-8">
								<input type="text" id="yearEdit" placeholder="Rok (np. 2019/2020)" class="form-control">
							</div>	
						</div>


						<div class="form-group">
							<div class="col-md-8">
								<input type="text" id="contactEdit" placeholder="Kontakt do przedstawiciela grupy" class="form-control">
							</div>	
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<input type="submit" value="Zapisz zmiany" id="submitEditGroup" class="btn btn-outline-secondary button-1 float-right"
							>
							</div>	
						</div>

					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


						<input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">

						<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/groups/show.blade.php ENDPATH**/ ?>