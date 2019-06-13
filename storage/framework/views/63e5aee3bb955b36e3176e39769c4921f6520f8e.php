<?php $__env->startSection('content'); ?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5>  
						<b>  
							Twoje grupy
						</b>
						
					</h5>
					
					 
					
				</div>

				<div class="card-body justify-content-center">
					<div>
						<div class="alert alert-success alert-block"  id="success-info" style="display: none">
							<button type="button" class="close" data-dismiss="alert" >×</button> 
							<strong>
								<p id="info">
								</p>
							</strong>
						</div>

					</div>

					<b>   
						<a href=""  id="newGroup" class="float-right" style="color: black" data-toggle="modal" data-target="#addGroup">
							<i class="fas fa-plus-circle fa-lg"></i> Dodaj grupę 	</a>

						</b>

						<br> <br>

						<table class="table table-bordered table-sm table-responsive-sm">
							<thead>
								<tr>
									<th scope="col">Nazwa Grupy</th>
									<th scope="col">Rok</th>
									<th scope="col">Kontakt do starosty</th>
									<th scope="col">Lista studentów</th>
									<th scope="col"><i class="fas fa-cog fa-lg"></i>



									</th>

								</tr>
							</thead>
							<tbody id="groups-tbody">


								<?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								<tr>
									<td> <?php echo e($group->name); ?> </td>

									<td> <?php echo e($group->year); ?> </td>
									<td> <?php echo e($group->contact); ?></td>
									<td>   <a href="<?php echo e(url('groups', $group->id)); ?>"> 

										<i class="far fa-address-card fa-lg" style="color: black"></i>

									</a></td>


									<td>

										<a href="" data-toggle="modal" data-target="#editGroup" data-id="<?php echo e($group->id); ?>" 
											data-name="<?php echo e($group->name); ?>" data-year="<?php echo e($group->year); ?>" data-contact="<?php echo e($group->contact); ?>" class="btn btn-light btn-sm edit-group"><i class="far fa-edit fa-lg"></i></a>


											<input type="hidden" name="subjectId" id="subjectId" value="<?php echo e($group->id); ?>">
											<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="<?php echo e($group->id); ?>" id="delete-group" class="btn btn-light btn-sm">
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


		
		<div class="modal fade" id="addGroup" tabindex="-1" role="dialog" data-dismiss="modal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Dodaj nową grupę</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>


					<div class="modal-body float-center">

						<div class="form-group">
							<div class="col-md-8">
								<input type="text" id="name" placeholder="Nazwa grupy" class="form-control" >
							</div>	
						</div>

						<div class="form-group">
							<div class="col-md-8">
								<input type="text" id="year" placeholder="Rok (np. 2019/2020)" class="form-control">
							</div>	
						</div>


						<div class="form-group">
							<div class="col-md-8">
								<input type="text" id="contact" placeholder="Kontakt do przedstawiciela grupy" class="form-control">
							</div>	
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<input type="submit" value="Dodaj grupę" id="submitGroup" class="btn btn-outline-secondary button-1 float-right"
								data-dismiss='modal'>
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
						<h4 class="modal-title">Czy na pewno chcesz usunąć tę grupę?</h4>


						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<button type="button" id="confirm-delete-group" class="btn btn-outline-danger float-right"
						data-dismiss="modal">Tak</button>
					</div>


				</div>
			</div>
		</div>

		

		
		<div class="modal fade" id="editGroup" tabindex="-1" role="dialog" data-dismiss="modal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Edytuj grupę</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>


					<div class="modal-body float-center">

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
								data-dismiss='modal'>
							</div>	
						</div>

					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->






		<input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aba\Desktop\LARAVEL ALL\panelwykladowcy\resources\views/groups/index.blade.php ENDPATH**/ ?>