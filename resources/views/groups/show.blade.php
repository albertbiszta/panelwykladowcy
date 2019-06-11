@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">
					{{$group->name}}
				</div>

				<div class="card-header">
					
					<b>  
						<a href=""  id="newStudent" class="float-right" style="color: black" data-toggle="modal" data-target="#addStudent">
							<i class="fas fa-plus-circle fa-lg"></i> Dodaj studentów 	</a>
						</b>
					</div>
					<input type="hidden" name="groupId" id="groupId" value="{{ $group->id }}">

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
									<td> {{$student->lastname}} </td>
									<td> {{$student->firstname}} </td>
									<td> {{$student->indexNumber}} </td>
									<td> {{$student->contact}} </td>





									<td>



										<a href="" data-toggle="modal" data-target="#editStudent" data-id="{{$student->id}}" data-name="{{$student->name}}" class="btn btn-light btn-sm edit-subject"><i class="far fa-edit fa-lg"></i></a>


										<input type="hidden" name="studentId" id="studentId" value="{{ $student->id }}">
										<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="{{$student->id}}" id="delete-student" class="btn btn-light btn-sm">
											<i class="far fa-trash-alt fa-lg"></i>
										</button>





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

	<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" data-dismiss="modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Dodaj studenta</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				</div>
				<div class="modal-body">
					{!! Form::hidden('group_id', $group->id) !!}


					<div class="form-group">
						<div  class="col-md-4 control-label">
							{!! Form::label('firstname','Imię:') !!}
						</div>
						<div class="col-md-6">
							{!! Form::text('firstname',null,['class'=>'form-control', 'id'=>'firstname']) !!}
						</div>
					</div>


					<div class="form-group">
						<div  class="col-md-4 control-label">
							{!! Form::label('lastname','Nazwisko:') !!}
						</div>
						<div class="col-md-6">
							{!! Form::text('lastname',null,['class'=>'form-control', 'id'=>'lastname']) !!}
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
							{!! Form::submit('Dodaj studenta',['class'=>'btn btn-secondary', 'id'=>"submitStudent"
								,
								'data-dismiss'=>'modal']) !!}
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

		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

		@endsection