<div>@extends('layouts.app')
	@section('content')
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="card"  style="width: 65rem;" >

				<div class="card-body">
					<ul class="nav nav-tabs">

						<li class="nav-item dropdown"  style="width: 60rem;">
							<a class="btn btn-outline-secondary btn-lg btn-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Wyświetl Syllabus
							</a>

							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">


								<a class="dropdown-item" href="#" style="width: 60rem;">

									<p>	<b>Język prowadzenia: </b> {{$subject->syllabus->language}}  </p>
									<p>	<b>Punkty ECTS: </b> {{$subject->ects}}  </p>
									<p>	<b>Przedmiot kończy się egzaminem: </b> 

										@if ($subject->exam == 1)
										Tak

										@else
										Nie

										@endif

									</p>


									<p>  <b>Opis: </b>  {{$subject->syllabus->description}} </p>

									

									<p> <b>Literaura: </b> {{$subject->syllabus->literature}}   </p>
					p>

								</a>




							</li>
						</ul>



					</div>

					<div class="card-body">
						<h6>Wyświetl Syllabus</h6>

						{{$subject->syllabus->description}}






					</div>





					<div class="card-body">
						<table class="table table-borderless">
							<thead>
								<tr>
									<th scope="col">Nazwa</th>
									<th scope="col">Rok</th>

									<th scope="col"><i class="fas fa-cog fa-lg"></i>



									</th>

								</tr>
							</thead>
							<tbody>


								@foreach($subject->groups as $group)

								<tr>
									<td> {{$group->name}} </td>


									<td> {{$group->year}} </td>

									<td>



										{!! Form::open(['action'=> ['SubjectController@unassignGroup',
											$subject->id, $group->id],
											'method'=>'POST', 'class' =>'form-horizontal']) !!}


											{{ Form::hidden('_method', 'DELETE') }}
											{{ Form::button('<i class="far fa-trash-alt fa-lg"></i>', [ 'type'=>'submit' , 'class' => 'btn btn-light btn-sm']) }}


											{!! Form::close() !!}				




										</td>



									</tr>

									@endforeach

								</tbody>
							</table>

						</div>
						<!-- Formularz -->

						{!! Form::open(['route'=> ['subjects.assignGroup', $subject->id], 'class' =>'form-horizontal']) !!}



						<div class="form-group">
							<div  class="col-md-4">

								<select class="form-control" name="groups" id="exampleFormControlSelect2">
									<option value="" disable="true" selected="true"> Wybierz grupę </option>
									@foreach($groups as $key => $value)

									@if(!$subject->groups->contains($key))

									<option value="{{$key}}">{{$value}} </option>

									@endif

									@endforeach
								</select>


							</div></div>

							<div class="form-group">
								<div class="col-md-4 col-md-offset-4">
									{!! Form::submit('Dodaj grupę do przedmiotu',['class'=>'btn btn-primary']) !!}
								</div>
							</div>







							{!! Form::close() !!}







						</div>




					</div>
				</div>
			</div>



		@endsection</div>