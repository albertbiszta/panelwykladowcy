@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">
						Oceny z przedmiotu
					<b> 
						<a href="{{ url('subjects', $subject->id) }}" style="color: black"> 
							{{$subject->name}}

						</a> 
					</b>
					Grupa: 
					<b> 
						<a href="{{ url('groups', $group->id) }}" style="color: black"> 
							{{$group->name}}

						</a>
					</b>
				</div>

				{{-- <div class="card-header">
					
					<a href="{{route('addStudent', $group->id)}}"> <i class="fas fa-plus-circle fa-lg"></i> 
					Dodaj studentów </a>
				</div> --}}


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
						<a href=""  id="newGrade" class="float-right" style="color: black" data-toggle="modal" data-target="#addGrade">
							<i class="fas fa-plus-circle fa-lg"></i> Dodaj ocenę 	</a>

						</b>

						<br> <br>


						<table class="table table-bordered table-sm table-responsive-sm">
							<thead>
								<tr>
									<th scope="col">Nazwisko</th>
									<th scope="col">Imię</th>
									<th scope="col">Numer indeksu</th>
									<th scope="col">Oceny</th>



								</th>

							</tr>
						</thead>
						<tbody>


							@foreach($group->students as $student)

							<tr>
								<td> {{$student->lastname}} </td>
								<td> {{$student->firstname}} </td>
								<td> {{$student->indexNumber}} </td>




								<td>
									@foreach($student->grades as $grade) 
									{{$grade->value}} 
									@endforeach
								</td>






							</tr>

							@endforeach

						</tbody>
					</table>

				</div>
{{-- 
				<div class="card-body">

					<h6>Dodaj ocenę</h6>


					<!-- Formularz -->
					{!! Form::open(['action'=> ['GradeController@addGrade',
						$subject->id],
						'method'=>'POST', 'class' =>'form-horizontal']) !!}


						<div class="form-group">
							<div  class="col-md-4 control-label">

							</div>
							<div class="col-md-6">
								<select class="form-control" name="student" id="exampleFormControlSelect2">
									<option value="" disable="true" selected="true"> Wybierz studenta </option>
									@foreach($group->students as $student)



									<option value="{{$student->id}}">  {{$student->lastname}} {{$student->firstname}}</option>



									@endforeach
								</select>

							</div>
						</div>




						<div class="form-group">
							<div  class="col-md-4 control-label">

							</div>
							<div class="col-md-6">
								{!! Form::text('value',null,['class'=>'form-control', 'placeholder'=>'Ocena (np. 4.0)']) !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Dodaj ocenę',['class'=>'btn btn-outline-secondary float-right']) !!}
							</div>
						</div>







					</div> --}}
				</div>
			</div>
		</div>



		{{-- add modal --}}

		<div class="modal fade" id="addGrade" tabindex="-1" role="dialog" data-dismiss="modal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Dodaj ocenę </h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>


					<div class="modal-body float-center">

				<div class="alert alert-danger alert-block"  id="validation-info" style="display:none">

				</div>

						<!-- Formularz -->
					{!! Form::open(['action'=> ['GradeController@addGrade',
						$subject->id],
						'method'=>'POST', 'class' =>'form-horizontal', 'id'=> 'form-addGrade']) !!}


						<div class="form-group">
							<div  class="col-md-4 control-label">

							</div>
							<div class="col-md-8">
								<select class="form-control" name="student" id="student" >
									<option value="" disable="true" selected="true"> Wybierz studenta </option>
									@foreach($group->students as $student)

 

									<option value="{{$student->id}}">  {{$student->lastname}} {{$student->firstname}}</option>



									@endforeach
								</select>

							</div>
						</div>




						<div class="form-group">
							<div  class="col-md-4 control-label">

							</div>
							<div class="col-md-8">
								{!! Form::text('value',null,['class'=>'form-control', 'placeholder'=>'Ocena (np. 4.0)', 'id'=>'gradeValue']) !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Dodaj ocenę',['class'=>'btn btn-outline-secondary float-right']) !!}
							</div>
						</div>


							{!! Form::close() !!}



						</div>


					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->


			@endsection


