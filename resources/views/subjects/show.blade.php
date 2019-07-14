<div>@extends('layouts.app')
	@section('content')
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="card"  style="width: 65rem;" >


				<div class="card-header">
					<h5 id="subject-header">
						<b> {{$subject->name}} </b>   
						<div class="float-right">

							<a href="" data-toggle="modal" data-target="#editSubject" data-id="{{$subject->id}}" 
								data-name="{{$subject->name}}" data-ects="{{$subject->ects}}"
								class="btn btn-light btn-sm edit-subject">
								<i class="far fa-edit fa-lg"></i> Edytuj przedmiot
							</a>




						</div>

					</h5>  	
				</div>


				<div class="card-body">

					@if(Session::has('flash_message_error'))
					<div class="alert alert-error alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button> 
						<strong>{!! session('flash_message_error') !!}</strong>
					</div>
					@endif   
					@if(Session::has('flash_message_success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button> 
						<strong>{!! session('flash_message_success') !!}</strong>
					</div>
					@endif

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
						<a class="btn btn-outline-secondary button-1 showSyllabus-btn"  href="#" role="button" data-toggle="modal" data-target="#showSyllabus" aria-haspopup="true" aria-expanded="false">
							Wyświetl Syllabus
						</a>

						<a class="btn btn-outline-secondary button-1" id="open-assignGroup-modal" href="#" role="button" data-toggle="modal" data-target="#assignGroup" aria-haspopup="true" aria-expanded="false">
							Przypisz grupę 
						</a>



						<br> <br>



					</div>





					@if(count($subject->groups) > 0)


					<table class="table table-bordered table-sm table-responsive-sm">
						<thead>
							<tr>
								<th scope="col">Nazwa </th>
								
								<th scope="col">Lista studentów</th>
								<th scope="col">Oceny</th>
								<th scope="col">Zajęcia</th>

								<th scope="col"><i class="fas fa-cog fa-lg"></i>



								</th>

							</tr>
						</thead>
						<tbody id="groups-tbody">


							@foreach($subject->groups as $group)

							<tr>

								<td> 
									<a href="{{ url('groups', $group->id) }}" style="color: black"> 
										{{$group->name}}

									</a>

								</td>


								
								<td> 
									<a href="{{ url('groups', $group->id) }}" style="color: black"> 
										<i class="fas fa-user-graduate fa-lg" style="color: black"></i>

									</a>

								</td>
								<td> 
									<a href="{{ action('GradeController@groupGrades', [$subject->id, $group->id]) }}" style="color: black"> 
										<i class="far fa-file-alt fa-lg" style="color: black"></i>

									</a>

								</td>
								<td> 
									<a href="{{ action('LessonController@groupLessons', [$subject->id, $group->id]) }}" style="color: black"> 
										<i class="fas fa-chalkboard" style="color: black"></i>

									</a>

								</td>

								<td>



								{{-- 	{!! Form::open(['action'=> ['SubjectController@unassignGroup',
										$subject->id, $group->id],
										'method'=>'POST', 'class' =>'form-horizontal']) !!}


										{{ Form::hidden('_method', 'DELETE') }}
										{{ Form::button('<i class="far fa-trash-alt fa-lg"></i>', [ 'type'=>'submit' , 'class' => 'btn btn-light btn-sm']) }}


										{!! Form::close() !!}	 --}}		


										<input type="hidden" name="groupId" id="groupId" value="{{ $group->id }}">
										<button type="submit" data-toggle="modal" data-target="#confirm-unassign" data-id="{{$group->id}}" 
											id="unassign-group" class="btn btn-light btn-sm">
											<i class="far fa-trash-alt fa-lg"></i>
										</button>






									</td>





								</tr>

								@endforeach

							</tbody>
						</table>

						@else


						<h6><b> 
							<p>[ Nie dodałeś grup do tego przedmiotu ]</p>
						</b></h6>






						@endif

					</div>





				</div>
			</div>
		</div>


		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

		<input type="hidden" name="subjectId" id="subjectId" value="{{ $subject->id }}">




		{{-- show syllabus--}}

		<div class="modal fade" id="showSyllabus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<h4 class="modal-title"><b>Syllabus:  </b> {{$subject->name}}</h4>



						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						@if($subject->syllabus)
						<input type="hidden" name="syllabusId" id="syllabusId" value="{{$subject->syllabus->id}}">



						<p>	<b>Język prowadzenia: </b> {{$subject->syllabus->language}}  </p>
						<p>	<b>Punkty ECTS: </b> {{$subject->ects}}  </p>
						<p>	<b>Przedmiot kończy się egzaminem: </b> 

							@if ($subject->exam == 1)
							Tak

							@else
							Nie

							@endif

						</p>


						<p>  <b>Opis: </b>  {{$subject->syllabus->description}} </p>



						<p> <b>Literaura: </b> {{$subject->syllabus->literature}}   </p>

						
						<div class="float-right">  

						<a href="{{action('SyllabusController@edit', [$subject->syllabus->id])}}"
							class="btn btn-light btn-sm edit-student"><i class="far fa-edit fa-lg"></i></a>

							<button type="submit" data-id="{{$subject->syllabus->id}}" id="delete-syllabus" class="btn btn-light btn-sm">
								<i class="far fa-trash-alt fa-lg"></i>
							</button>

 </div>
				<br>

						@else
						<h6>  <b> Nie stworzyłeś jeszcze syllabusa do tego przedmiotu </b>  </h6>
						<br> <br> 	
						<a href="{{action('SyllabusController@create', [$subject->id])}}" style="color: black" class="float-right"> 
							<b>  Dodaj syllabus</b>

						</a>
						@endif
					</div>




				</div>
			</div>
		</div>

		{{--  --}}



		{{-- assign group --}}

		{!! Form::open(['route'=> ['subjects.assignGroup', $subject->id], 'class' =>'form-horizontal']) !!}


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
									@foreach($groups as $key => $value)

									@if(!$subject->groups->contains($key))

									<option value="{{$key}}">{{$value}} </option>

									@endif

									@endforeach
								</select>


							</div></div>



						</div>
						<div class="modal-footer">

							<div class="form-group">
								<div class="col-md-4 col-md-offset-4">
									{!! Form::submit('Dodaj grupę do przedmiotu',['class'=>'btn btn-outline-secondary button-1']) !!}
								</div>
							</div>

						{{-- <div class="form-group">
							<div class="col-md-4 col-md-offset-4">
								{!! Form::submit('Dodaj grupę do przedmiotu',['class'=>'btn btn-outline-secondary button-1',
								'data-dismiss'=>'modal', 'id'=>'assignSubmit']) !!}
							</div>
						</div> --}}

					</div>


					{!! Form::close() !!}


				</div>
			</div>
		</div>

		{{--  --}}


		{{-- confirm unassign modal --}}


		@if(count($subject->groups) > 0)
		<div class="modal fade" id="confirm-unassign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<h4 class="modal-title">Czy na pewno chcesz usunąć grupę z przedmiotu?</h4>


						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						{!! Form::open(['action'=> ['SubjectController@unassignGroup',
							$subject->id, $group->id],
							'method'=>'POST', 'class' =>'form-horizontal']) !!}


							{{ Form::hidden('_method', 'DELETE') }}
							{{ Form::button('Tak', [ 'type'=>'submit' , 'class' => 'btn btn-outline-danger float-right']) }}


							{!! Form::close() !!}

							
						</div>

						
					</div>
				</div>
			</div>

			@endif	




			{{-- edit modal --}}

			<div class="modal fade" id="editSubject" tabindex="-1" role="dialog" data-dismiss="modal" aria-label="Close">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Edytuj przedmiot</h4>

							<button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"><span >&times;</span></button>

						</div>


						<div class="modal-body">

							<input type="hidden" name="subjectId" id="subjectId">

							<div class="alert alert-danger alert-block"  id="validation-edit" style="display:none">

							</div>
							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('nameEdit','Nazwa:') !!}
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" name="name" id="nameEdit">

								</div>
							</div>

							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('ectEdits','Punkty ECTS:') !!}
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" name="ects" id="ectsEdit">
								</div>
							</div>




							<div class="form-group">
								<div  class="col-md-4 control-label">
									{!! Form::label('examEdit','Egzamin') !!}
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

		{{--  --}}







	</div>

	@endsection