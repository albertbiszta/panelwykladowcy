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

					<!-- Search form -->
	
					<form action="{{ route('students.search') }}" method="GET">
						@csrf
						<input class="form-control mr-sm-2" placeholder="Szukaj studenta (Imię Nazwisko)" id="query" 
						value="{{ request()->input('query')}}" type="text" name="query" />
						<br>
						<input type="submit" class="btn btn-sm btn-secendary" value="Szukaj" />
					</form>
					

				</div>
			</div>
		</div>
	</div>
</div>
@endsection