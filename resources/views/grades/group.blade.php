@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">
					<b> <a href="{{ url('groups', $group->id) }}" style="color: black"> 
						{{$group->name}}

					</a>  </b>
				</div>

				{{-- <div class="card-header">
					
					<a href="{{route('addStudent', $group->id)}}"> <i class="fas fa-plus-circle fa-lg"></i> 
					Dodaj studentów </a>
				</div> --}}

				<div class="card-body">
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
							{!! Form::submit('Dodaj ocenę',['class'=>'btn btn-primary']) !!}
						</div>
					</div>







				</div>
			</div>
		</div>
	</div>
	@endsection