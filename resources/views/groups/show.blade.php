@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">
					<h5 id="group-header">
						<b> {{$group->name}} </b>   
						<div class="float-right">

							
							<a href="" data-toggle="modal" data-target="#editGroup" data-id="{{$group->id}}" 
								data-name="{{$group->name}}"  data-contact="{{$group->contact}}" 
								class="btn btn-light btn-sm edit-group"><i class="far fa-edit fa-lg"></i>
								Edytuj grupę
							</a>




						</div>

					</h5>  	
				</div>

				<div class="card-header">

					<b>  
						<a href=""  id="newStudent" class="float-right new-student" style="color: black" data-toggle="modal" data-target="#addStudent">
							<i class="fas fa-plus-circle fa-lg"></i> Dodaj studentów 	</a>
						</b>
						<br> 
						<input type="hidden" name="groupId" id="groupId" value="{{$group->id}}">

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


									@foreach($students as $student)

									<tr>
										<td> {{$student->last_name}} </td>
										<td> {{$student->first_name}} </td>
										<td> {{$student->index_number}} </td>
										<td> {{$student->contact}} </td>





										<td>

											<div class="options-tab">



												<a href="" data-toggle="modal" data-target="#editStudent" data-id="{{$student->id}}" 
													data-firstname="{{$student->first_name}}" data-lastname="{{$student->last_name}}"
													data-indexnumber="{{$student->index_number}}"
													data-contact="{{$student->contact}}" 
													class="btn btn-light btn-sm edit-student"><i class="far fa-edit fa-lg"></i></a>

													<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="{{$student->id}}" id="delete-student" class="btn btn-light btn-sm">
														<i class="far fa-trash-alt fa-lg"></i>
													</button>


												</div>


											</td>






										</tr>

										@endforeach

									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>


			{{-- add modal --}}
			<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" data-dismiss="modal" aria-label="Close">

				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Dodaj studenta</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						</div>
						<div class="modal-body-add-student">
							<div class="alert alert-danger alert-block"  id="validation-info" style="display:none">

							</div>
							{!! Form::hidden('group_id', $group->id) !!}


							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('firstName','Imię:') !!}
								</div>
								<div class="col-md-6">
									{!! Form::text('firstName',null,['class'=>'form-control', 'id'=>'firstName']) !!}
								</div>
							</div>


							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('lastName','Nazwisko:') !!}
								</div>
								<div class="col-md-6">
									{!! Form::text('lastName',null,['class'=>'form-control', 'id'=>'lastName']) !!}
								</div>
							</div>

							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('indexNumber','Numer indeksu:') !!}
								</div>
								<div class="col-md-6">
									{!! Form::text('indexNumber',null,['class'=>'form-control', 'id'=>'indexNumber']) !!}
								</div>
							</div>

							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('contact','Kontakt:') !!}
								</div>
								<div class="col-md-6">
									{!! Form::text('contact',null,['class'=>'form-control', 'id'=>'contact']) !!}
								</div>
							</div>





						</div>
						<div class="modal-footer">
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									{!! Form::submit('Dodaj studenta',['class'=>'btn btn-outline-secondary button-1', 'id'=>"submitStudent"
									]) !!}
								</div>
							</div>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->



			{{-- edit modal --}}
			<div class="modal fade" id="editStudent" tabindex="-1" role="dialog" data-dismiss="modal" aria-label="Close">

				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Zaktualizuj dane studenta</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						</div>
						<div class="modal-body">
							<div class="alert alert-danger alert-block"  id="validation-edit-student" style="display:none">

							</div>
							{!! Form::hidden('group_id', $group->id) !!}


							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('firstNameEdit','Imię:') !!}
								</div>
								<div class="col-md-6">

									{!! Form::text('firstNameEdit',null,['class'=>'form-control', 'id'=>'firstNameEdit']) !!}
								</div>
							</div>


							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('lastNameEdit','Nazwisko:') !!}
								</div>
								<div class="col-md-6">
									{!! Form::text('lastNameEdit',null,['class'=>'form-control', 'id'=>'lastNameEdit']) !!}
								</div>
							</div>

							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('indexNumberEdit','Numer indeksu:') !!}
								</div>
								<div class="col-md-6">
									{!! Form::text('indexNumberEdit',null,['class'=>'form-control', 'id'=>'indexNumberEdit']) !!}
								</div>
							</div>

							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('contactEdit','Kontakt:') !!}
								</div>
								<div class="col-md-6">
									{!! Form::text('contactEdit',null,['class'=>'form-control', 'id'=>'contactEdit']) !!}
								</div>
							</div>





						</div>
						<div class="modal-footer">
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									{!! Form::submit('Zapisz zmiany',['class'=>'btn btn-outline-secondary button-1', 'id'=>"submitEditStudent"
									]) !!}
								</div>
							</div>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->





			{{-- confirm delete modal --}}

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

			{{--  --}}


			{{-- edit group --}}
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


			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

			@endsection