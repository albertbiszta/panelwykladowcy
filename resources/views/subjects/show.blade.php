<div>@extends('layouts.app')
	@section('content')
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="card"  style="width: 65rem;" >

				<div class="card-body">


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
							<a class="btn btn-outline-secondary button-1" href="#" role="button" data-toggle="modal" data-target="#showSyllabus" aria-haspopup="true" aria-expanded="false">
								Wyświetl Syllabus
							</a>

							<a class="btn btn-outline-secondary button-1" id="open-assignGroup-modal" href="#" role="button" data-toggle="modal" data-target="#assignGroup" aria-haspopup="true" aria-expanded="false">
								Przypisz grupę do przedmiotu
							</a>



							<br> <br>

							

						</div>






						

						<table class="table table-bordered table-sm table-responsive-sm">
							<thead>
								<tr>
									<th scope="col">Nazwa </th>
									<th scope="col">Rok</th>
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


									<td> {{$group->year}} </td>
									<td> 
										<a href="{{ url('groups', $group->id) }}" style="color: black"> 
											IKONA

										</a>

									</td>
									<td> 
										<a href="{{ action('GradeController@groupGrades', [$subject->id, $group->id]) }}" style="color: black"> 
											IKONA  oceny

										</a>

									</td>
									<td> 
										<a href="{{ action('LessonController@groupLessons', [$subject->id, $group->id]) }}" style="color: black"> 
											IKONA  zajęcia

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

					</div>
					<div class="card-header">

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

						@else
						<h6>  <b> Nie stworzyłeś jeszcze syllabusa do tego przedmiotu </b>  </h6>	
						<a href="{{action('SyllabusController@create')}}" style="color: black"> 
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

			











		@endsection</div>