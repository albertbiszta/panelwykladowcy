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

					<div id="main">

						@if(count($lesson->attendances) > 0)

						<button class="btn btn-outline-secondary float-right" id="update-attendance"> Zatwierdź zmiany w obecności</button>
						<br> <br>

						<table class="table table-bordered table-sm table-responsive-sm">
							<thead>
								<tr>
									<th scope="col">Nazwisko</th>
									<th scope="col">Imię</th>
									<th scope="col">Numer indeksu</th>
									<th scope="col">Status obecności</th>


								</tr>
							</thead>
							<tbody id="attendances-tbody">


								@foreach($lesson->attendances as $attendance)


								@foreach($group->students as $student)


								@if($attendance->student_id == $student->id)

								<tr>


									<td> {{$student->lastname}} </td>
									<td> {{$student->firstname}} </td>
									<td> {{$student->indexNumber}} </td> 



									<td> 


										<select class="form-control" name="status" id="status" data-id="{{$attendance->id}}">

											@if($attendance->status == 'Obecny')
											<option value="Obecny" disable="true" selected="true"> Obecny </option>
											<option value="Nieobecny"> Nieobecny </option>
											<option value="Nieobecność usprawiedliwiona"> Nieobecność usprawiedliwiona </option>


											@elseif($attendance->status == 'Nieobecny')

											<option value="Nieobecny" disable="true" selected="true"> Nieobecny </option>
											<option value="Obecny"> Obecny </option>
											<option value="Nieobecność usprawiedliwiona"> Nieobecność usprawiedliwiona </option>

											@else
											<option value="Nieobecność usprawiedliwiona" disable="true" selected="true"> Nieobecność usprawiedliwiona </option>
											<option value="Obecny"> Obecny </option>
											<option value="Nieobecny"> Nieobecny </option>

											@endif
											


										</select>


									{{-- <div > 
										<select class="form-control" name="status" id="status" data-id="{{$student->id}}">
											<option value="Obecny" disable="true" selected="true"> Obecny </option>


											<option value="Nieobecny"> Nieobecny </option>
											<option value="Nieobecność usprawiedliwiona"> Nieobecność usprawiedliwiona </option>


										</select>
									</div>
									--}}
								</td>




							</tr>

							@endif

							@endforeach
							@endforeach

						</tbody>
					</table>




					@else

					<button class="btn btn-outline-secondary float-right" id="submit-attendance"> Zatwierdź obecność </button>
					<br> <br>



					<table class="table table-bordered table-sm">
						<thead>
							<tr>
								<th scope="col">Nazwisko</th>
								<th scope="col">Imię</th>
								<th scope="col">Numer indeksu</th>
								<th scope="col">Status obecności</th>







							</tr>
						</thead>
						<tbody>


							@foreach($group->students as $student)


							<tr>


								<td> {{$student->lastname}} </td>
								<td> {{$student->firstname}} </td>
								<td> {{$student->indexNumber}} </td>



								<td> 


									<div > 
										<select class="form-control" name="status" id="status" data-id="{{$student->id}}">
											<option value="Obecny" disable="true" selected="true"> Obecny </option>


											<option value="Nieobecny"> Nieobecny </option>
											<option value="Nieobecność usprawiedliwiona"> Nieobecność usprawiedliwiona </option>


										</select>
									</div>

								</td>




							</tr>

							@endforeach

						</tbody>
					</table>

					@endif





				</div>	




			</div>


			<input type="hidden" name="lessonId" id="lessonId" value="{{ $lesson->id }}">

			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">






		</div>
	</div>
</div>
</div>
@endsection