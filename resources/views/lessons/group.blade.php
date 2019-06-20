@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">
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

					   <a href="{{ action('GradeController@groupGrades', [$subject->id, $group->id]) }}" class="float-right" style="color: black"> 
                      <i class="far fa-file-alt fa-lg" style="color: black"></i>
                      Wyświetl oceny

                  </a>
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
 

					<a class="btn btn-outline-secondary button-1 float-right" id="open-addLesson-modal" href="#" role="button" data-toggle="modal" 
					data-target="#addLesson" aria-haspopup="true" aria-expanded="false">
					Dodaj zajęcia
				</a>


			</div>



			<div class="card-body">

				@if((count($subject->lessons) > 0) && (count($group->lessons) > 0))
				<table class="table table-bordered table-sm table-responsive-sm">
					<thead>
						<tr>
							<th scope="col">Data</th>
							<th scope="col">Temat zajęć</th>
							<th scope="col">Status</th>
							<th scope="col">Zmień status</th>
							<th scope="col">Obecność</th>




						</th>

					</tr>
				</thead>
				<tbody id="lessons-tbody">


					@foreach($group->lessons as $groupLesson)
					@foreach($subject->lessons as $subjectLesson)
					@if($groupLesson->id == $subjectLesson->id)





					<tr>
						<td> 
							{{ $groupLesson->date->format('d-m-Y') }} 
						</td>
						<td> {{$groupLesson->topic}} </td>


						@if ($groupLesson->performed == 1)
						{{-- grid here --}}
						<td> 	
							Odbyły się
						</td>

						<td> 	



						</td>

						@else
						<td> 	
							Nie odbyły się
						</td>

						<td> 	
							{!! Form::model($groupLesson, ['method'=>'PATCH', 
							'action'=>['LessonController@editStatus', $groupLesson->id]]) !!}
							{!! Form::hidden('performed', 1) !!}




							{{ Form::button('<i class="fas fa-plus-circle fa-lg"></i>', [ 'type'=>'submit' , 'class' => 'btn btn-light btn-sm']) }}



							{!! Form::close() !!}   

						</td>


						@endif




						<td>
							@if ($groupLesson->performed == 1)

							<a href="{{ action('AttendanceController@lessonAttendance', $groupLesson->id) }}" style="color: black"> 
								<i class="fas fa-chalkboard" style="color: black"></i>

							</a>
							@endif	
						</td>









					</tr>
					@endif
					@endforeach
					@endforeach

				</tbody>
				<tfoot class="table-borderless">
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th>   Liczba odbytych zajęć: </th>
						<th> {{ App\Lesson::where('subject_id', $subject->id)->where('group_id', $group->id)->where('performed', 1)->count() }}	</th>
					</tr>
				</tfoot>
			</table>

			@else
			<p>[ Nie dodałeś jeszcze zajęć dla tego przedmiotu i grupy ]</p>

			@endif

		</div>


		<div class="card-body">



			

			<h6><b>Frekwencja studentów</b></h6>




			<table class="table table-bordered table-sm table-responsive-sm">
				<thead>
					<tr>
						<th scope="col">Nazwisko i Imię</th>
						<th scope="col">Obecności</th>
						<th scope="col">Nieobecności</th>
						<th scope="col">Nb. usprawiedliwione</th>



					</th>

				</tr>
			</thead>
			<tbody id="students-tbody">


				@foreach($group->students as $student)

				<?php
				$ob = 0;
				$nb = 0;
				$uspr = 0;
				?>

				<tr>
					<td> {{$student->lastName}} {{$student->firstName}}  </td>

					<?php
					$studentAttendances = App\Student::studentAttendances($student->id,$subject->id);

					?>

					<td>

						{{-- {{App\Student::studentAttendances($student->id,$subject->id)['ob']}} --}}
						{{$studentAttendances['ob']}}

					</td>

					<td>
						{{$studentAttendances['nb']}}
					</td>

					<td>
						{{$studentAttendances['uspr']}}
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
</div>
 

<input type="hidden" name="subjectId" id="subjectId" value="{{ $subject->id }}">
<input type="hidden" name="groupId" id="groupId" value="{{ $group->id }}">

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">





{{-- add modal --}}
<div class="modal fade" id="addLesson" tabindex="-1" role="dialog" data-dismiss="modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Dodaj nowe zajęcia</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

			</div>
			<div class="modal-body">

				<div class="alert alert-danger alert-block"  id="validation-info" style="display:none">

				</div>

				


				{!! Form::open(['action'=> ['LessonController@add',
					$subject->id, $group->id],
					'method'=>'POST', 'class' =>'form-horizontal', 'id'=>'form-addLesson',]) !!}

					<div class="form-group">
						<div  class="col-md-4 control-label">
							{!! Form::label('date', 'Data zajęć:') !!}
						</div>
						<div class="col-md-8">

							{!! Form::date('date', date('D-m-y'),['class' => 'form-control', 'id'=>'lessonDate']) !!}
						</div>
					</div>





					<div class="form-group">
						<div  class="col-md-4 control-label">
							{!! Form::label('topic','Temat:') !!}
						</div>
						<div class="col-md-8">
							{!! Form::textarea('topic',null,['class'=>'form-control','rows' => 2, 'cols' => 54, 'style' => 'resize:none', 'id'=>'topic']) !!}
						</div>
					</div>

					<div class="form-group">
						<div  class="col-md-8 control-label">

						</div>
						<div class="col-md-8">
							{!! Form::label('performed','Odbył się:') !!}

							{!! Form::checkbox('performed', 1 ); !!}

						</div>
					</div>

					<div class="modal-footer">

						<div class="form-group">



							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Dodaj zajęcia',['class'=>'btn btn-outline-secondary float-right', 'id'=>'lesson-submit']) !!}

							</div>
						</div>

						{!! Form::close() !!}   
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{--  --}}

@endsection

