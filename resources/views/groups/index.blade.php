@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<b>  
						<a href=""  id="newGroup" class="float-right" style="color: black" data-toggle="modal" data-target="#addGroup">
							<i class="fas fa-plus-circle fa-lg"></i> Dodaj grupę 	</a>
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
						<table class="table table-borderless">
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


								@foreach($groups as $group)

								<tr>
									<td> {{$group->name}} </td>

									<td> {{$group->year}} </td>
									<td> {{$group->contact}}</td>
									<td>   <a href="{{ url('groups', $group->id) }}"> 

										<i class="far fa-address-card fa-lg" style="color: black"></i>

									</a></td>


									<td>


										{!! Form::open(['action'=> ['GroupController@destroy', $group->id],
										'method'=>'POST', 'class' =>'form-horizontal']) !!}
										<a href="{{ route('groups.edit', $group->id) }}" class="btn btn-light btn-sm"><i class="far fa-edit fa-lg"></i></a>

										{{ Form::hidden('_method', 'DELETE') }}
										{{ Form::button('<i class="far fa-trash-alt fa-lg"></i>', [ 'type'=>'submit' , 'class' => 'btn btn-light btn-sm']) }}


										{!! Form::close() !!}				








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
							<input type="submit" value="Dodaj grupę" id="submitGroup" class="btn btn-secondary float-right"
							data-dismiss='modal'>
						</div>	
					</div>



				</div>
				

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	{{--  --}}
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

	@endsection