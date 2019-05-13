@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<i href="/subjects/create" class="fas fa-plus-circle fa-lg"></i>
					<a href="/subjects/create">Dodaj przedmiot 	</a>
				</div>

				<div class="card-body">
					<table class="table table-borderless">
						<thead>
							<tr>
								<th scope="col">Nazwa przedmiotu</th>
								{{-- <th scope="col">Sylabus</th>
 --}}								<th scope="col">Punkty ECTS</th>
								<th scope="col">Egzamin</th>
								{{-- <th scioe="col">Lista grup</th> --}}
								<th scope="col"><i class="fas fa-cog fa-lg"></i>



								</th>
								
							</tr>
						</thead>
						<tbody>

						
							@foreach($subjects as $subject)
				
							<tr>
								<td> {{$subject->name}} </td>
								{{-- <td>   	<a href="{{ route('syllabuses.show', $subject->id) }}" class="btn btn-light btn-sm"><i class="far fa-folder-open fa-lg"></i></a>      </td> --}}
								<td> {{$subject->ects}} </td>
								<td> 
									@if ($subject->exam == 1)
									Tak

									@else
									Nie

									@endif

								</td>

								{{-- <td>   <a href="{{ url('subjects', $subject->id) }}"> 
								
									<i class="far fa-list-alt fa-lg" style="color: black"></i>

								 </a></td> --}}

								


								<td>
									
								{!! Form::open(['action'=> ['SubjectController@destroy', $subject->id],
												'method'=>'POST', 'class' =>'form-horizontal']) !!}
													<a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-light btn-sm"><i class="far fa-edit fa-lg"></i></a>

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