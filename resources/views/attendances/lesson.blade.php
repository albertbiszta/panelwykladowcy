@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">
					Lista obecności: <b>  {{ $lesson->date->format('d-m-Y') }}  </b>       
					Przedmiot:  
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

					<?php
					$students = [];

					?>

					<!-- Formularz -->
					{!! Form::open(['action'=> ['AttendanceController@saveAttendance',
						$lesson->id],
						'method'=>'POST', 'class' =>'form-horizontal']) !!}


					{!! Form::submit('Zatwierdź obecność',['class'=>'btn btn-secondary']) !!}


					<table class="table table-borderless">
						<thead>
							<tr>
								<th scope="col">Nazwisko</th>
								<th scope="col">Imię</th>
								<th scope="col">Numer indeksu</th>
								<th scope="col">Status obecności</th>




							</th>

						</tr>
					</thead>
					<tbody>


						@foreach($group->students as $student)

						<?php
						array_push($students, $student->id)

						?>


						<tr>
							<td> {{$student->lastname}} </td>
							<td> {{$student->firstname}} </td>
							<td> {{$student->indexNumber}} </td>


							 {{ Form::hidden($student->id, $student->id) }}

							<td>

								
								<div class="col-md-6">
									<select class="form-control" name="status" id="exampleFormControlSelect2">
										<option value="Obecny" disable="true" selected="true"> Obecny </option>


										<option value="Nieobecny"> Nieobecny </option>
										<option value="Nieobecność upsrawiedliona"> Nieobecność upsrawiedliona </option>


									</select>
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
@endsection