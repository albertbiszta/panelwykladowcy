@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">
					Zajęcia z przedmiotu:
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

				<div class="card-body">
					<table class="table table-borderless">
						<thead>
							<tr>
								<th scope="col">Data</th>
								<th scope="col">Temat zajęć</th>
								<th scope="col">Status(zmień status)</th>

								


							</th>
							
						</tr>
					</thead>
					<tbody>


						@foreach($group->lessons as $groupLesson)
						@foreach($subject->lessons as $subjectLesson)
						@if($groupLesson->id == $subjectLesson->id)





						<tr>
							<td> 
								{{ $groupLesson->date->format('d-m-Y') }} 
							</td>
							<td> {{$groupLesson->topic}} </td>

							<td> 
								@if ($groupLesson->performed == 1)
								{{-- grid here --}}
								Odbyły się

								@else
								Nie odbyły się 
                                {!! Form::model($groupLesson, ['method'=>'PATCH',
                                'action'=>['LessonController@editStatus', $groupLesson->id]]) !!}
                                {!! Form::hidden('performed', 1) !!}

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">



                                     {{ Form::button('<i class="fas fa-plus-circle fa-lg"></i>', [ 'type'=>'submit' , 'class' => 'btn btn-light btn-sm']) }}
                                 </div>
                             </div>



                             {!! Form::close() !!}   

								@endif

							</td>









						</tr>
						@endif
						@endforeach
						@endforeach

					</tbody>
				</table>

			</div>

			<div class="card-body">

				<h6>Dodaj zajęcia</h6>

			</div>


			<!-- Formularz -->
			{!! Form::open(['action'=> ['LessonController@addLesson',
				$subject->id, $group->id],
				'method'=>'POST', 'class' =>'form-horizontal']) !!}

				<div class="form-group">
					<div  class="col-md-8 control-label">
						{!! Form::label('date', 'Data zajęć:') !!}
					</div>
					<div class="col-md-8">

						{!! Form::date('date', date('D-m-y'),['class' => 'form-control', 'required',
						'data-parsley-required-message' => 'Wybierz datę']) !!}
					</div>
				</div>





				<div class="form-group">
					<div  class="col-md-4 control-label">
						{!! Form::label('topic','Temat:') !!}
					</div>
					<div class="col-md-6">
						{!! Form::textarea('topic',null,['class'=>'form-control','rows' => 2, 'cols' => 54, 'style' => 'resize:none']) !!}
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

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						{!! Form::submit('Dodaj zajęcia',['class'=>'btn btn-secondary']) !!}
					</div>
				</div>






			</div>
		</div>
	</div>
</div>
@endsection