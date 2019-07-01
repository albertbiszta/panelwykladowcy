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
										<div class="grades-tab"> 

										@foreach($student->grades as $grade) 
										<a id="grade-square"  data-toggle="modal" data-target="#editGrade" data-id="{{$grade->id}}" 
											data-value="{{$grade->value}}">
											{{substr($grade->value,0,3)}} </a> 
											@endforeach

											
											<input class="form-control add-grade-input" name="add-grade-input" id="add-grade-input" data-id="{{$student->id}}">

											
											</div>
										</td>

										<td>
											<b>  {{ substr(App\Student::averageGrade($student->id,$subject->id), 0, 4) }}  </b>
											
										</td>






									</tr>

									@endforeach

								</tbody>
							</table>

							

						</div>






						{{-- edit grade --}}
						<div class="modal fade" id="editGrade" tabindex="-1" role="dialog" data-dismiss="modal" aria-label="Close">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Edytuj / Usuń ocenę </h4>
										
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

									</div>


									<div class="modal-body float-center">

										<div class="alert alert-danger alert-block"  id="validation-edit" style="display:none">

										</div>
										
										

										<button type="submit" data-toggle="modal" data-target="delete-grade" id="delete-grade" 
										class="btn btn-light float-right">
										<i class="far fa-trash-alt fa-lg"></i> <b>Usuń ocenę </b>
									</button>






									<div class="form-group">
										<div  class="col-md-4 control-label">

										</div>
										<div class="col-md-8">
											{!! Form::text('value',null,['class'=>'form-control', 'placeholder'=>'Ocena (np. 4.0)', 'id'=>'editGradeValue']) !!}
										</div>
									</div>

									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											{!! Form::submit('Zapisz zmiany',['class'=>'btn btn-outline-secondary float-right', 'id'=>'submitGradeUpdate']) !!}
										</div>
									</div>


									

								</div>

							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->


					<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
					<input type="hidden" name="subjectId" id="subjectId" value="{{$subject->id}}">
					<input type="hidden" name="groupId" id="groupId" value="{{$group->id}}">



					@endsection


