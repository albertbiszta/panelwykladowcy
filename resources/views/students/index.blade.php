

@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					{{-- <i href="/subjects/create" class="fas fa-plus-circle fa-lg"></i>
					<a href="/subjects/create">Dodaj przedmiot 	</a> --}}
					<h5> Znajdź studenta</h5>
				</div>

				<div class="card-body">


					<input class="form-control mr-sm-2" placeholder="Szukaj studenta (Imię Nazwisko)" id="query" 
					type="text" name="query" />
					

					<div class="card-body"  id="no-result" style="display: none">



					</div>


	
						
					<table class="table table-borderless table-sm table-responsive-sm student-results-table" style="display: none">
						<thead>
							<tr>
								<th scope="col">Imię</th>
								<th scope="col">Nazwisko</th>
								<th scope="col">Numer indeksu</th>
								<th scope="col">Groupa</th>
								<th scope="col">Wyświetl szczegóły</th>



							</th>

						</tr>
					</thead>
					<tbody id="results">




					</tbody>
				</table>


			</div>
		</div>
	</div>
</div>
</div>
@endsection

