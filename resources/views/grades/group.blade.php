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
						{{-- <a href=""  id="newGrade" class="float-right" style="color: black" data-toggle="modal" data-target="#addGrade">
							<i class="fas fa-plus-circle fa-lg"></i> Dodaj ocenę 	</a> --}}


							
					<a href="{{ route('lessons.group',[$subject->id, $group->id]) }}" style="color: black"> 
						<i class="far fa-arrow-alt-circle-left  fa-lg"></i> Wróć do zajęć   </a>
						<div class="float-right" > 
							<a class="btn btn-outline-secondary button-1 btn-sm" role="button" id="save-grades">
								Zatwierdź oceny
							</a>



						</div>


						</b>

						<br> <br>


						<table class="table table-bordered table-sm table-responsive-sm">
							<thead>
								<tr>
									<th scope="col">Nazwisko</th>
									<th scope="col">Imię</th>
									<th scope="col">Numer indeksu</th>
									<th scope="col">Oceny <div class="float-right">Dodaj  </div></th>

									<th scope="col">Średnia</th>



								</th>

							</tr>
						</thead>
						<tbody>
  

							@foreach($group->students as $student)

							<tr>
								<td> {{$student->lastName}} </td>
								<td> {{$student->firstName}} </td>
								<td> {{$student->indexNumber}} </td>

 
								<td>

									@foreach($student->grades as $grade) 
									<a id="grade-square"  data-toggle="modal" data-target="#editGrade" data-id="{{$student->id}}">
									  {{substr($grade->value,0,3)}} </a> 
									@endforeach

										
										<input class="form-control add-grade-input" name="add-grade-input" id="add-grade-input" data-id="{{$student->id}}">

									  
								</td>

								<td>
										<b>  {{ substr(App\Student::averageGrade($student->id,$subject->id), 0, 4) }}  </b>
									
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

 

									<option value="{{$student->id}}">  {{$student->lastName}} {{$student->firstName}}</option>



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






		{{-- edit grade --}}
		<div class="modal fade" id="editGrade" tabindex="-1" role="dialog" data-dismiss="modal" aria-label="Close">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
			
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>


					<div class="modal-body float-center">

								<div class="alert alert-danger alert-block"  id="validation-edit" style="display:none">

								</div>
		<div class="float-right">
			

											<button type="submit" data-toggle="modal" data-target="#confirm-delete" data-id="{{$group->id}}" id="delete-group" class="btn btn-light btn-sm">
												<i class="far fa-trash-alt fa-lg"></i> Usuń ocenę
											</button>

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

 

									<option value="{{$student->id}}">  {{$student->lastName}} {{$student->firstName}}</option>



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


<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="subjectId" id="subjectId" value="{{$subject->id}}">
<input type="hidden" name="groupId" id="groupId" value="{{$group->id}}">



			@endsection


