@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
	
					<a href="/studentse">  	</a>

					<h5>Wyniki wyszukiwania</h5>
				</div>

				<div class="card-body">

				 <div class="search-container">
				 	<table class="table table-borderless">
						<thead>
							<tr>
								<th scope="col">Imię</th>
								<th scope="col">Nazwisko</th>
								<th scope="col">Grupa</th>
								<th scope="col">Numer indeksu</th>
						{{-- 		<th scope="col"><i class="fas fa-cog fa-lg"></i> --}}
								


								</th>
								
							</tr>
						</thead>
						<tbody>


							@foreach($students as $student)

							<tr>
								<td>{{$student->firstname}} </td>

								<td> {{$student->lastname}} </td>
								<td> {{$student->indexNumber}}</td>
										<td> {{$student->group->name}}</td>
						
								

								


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
@endsection