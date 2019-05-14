@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">
				{{$group->name}}
				</div>

				<div class="card-header">
					
					<a href="{{route('addStudent', $group->id)}}"> <i class="fas fa-plus-circle fa-lg"></i> 
					Dodaj studentów </a>
				</div>

				<div class="card-body">
					<table class="table table-borderless">
						<thead>
							<tr>
								<th scope="col">Nazwisko</th>
								<th scope="col">Imię</th>
								<th scope="col">Numer indeksu</th>
								<th scope="col">Kontakt</th>
								<th scope="col"><i class="fas fa-cog fa-lg"></i>
								


								</th>
								
							</tr>
						</thead>
						<tbody>


							@foreach($students as $student)

							<tr>
								<td> {{$student->lastname}} </td>
								<td> {{$student->firstname}} </td>
								<td> {{$student->indexNumber}} </td>
								<td> {{$student->contact}} </td>
								

								<td>
							
									
								</td>

								<td>


									{!! Form::open(['action'=> ['StudentController@destroy', $student->id],
									'method'=>'POST', 'class' =>'form-horizontal']) !!}
									<a href="{{ route('students.edit', $student->id) }}" class="btn btn-light btn-sm"><i class="far fa-edit fa-lg"></i></a>

									{{ Form::hidden('_method', 'DELETE') }}
									{{ Form::button('<i class="far fa-trash-alt fa-lg"></i>', [ 'type'=>'submit' , 'class' => 'btn btn-light btn-sm']) }}


									{!! Form::close() !!}				







									
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