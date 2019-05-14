@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-body">
{{-- 
	<a href="{{ route('subject-groups.create', $subject->id) }}"> Dodaj grupę do przedmiotu </a> --}}




</div>

<div class="card-body">

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


		</div>

		
		

	</div>

	<div class="form-group">
		<div class="col-md-4 col-md-offset-4">
			{!! Form::submit('Dodaj grupę do przedmiotu',['class'=>'btn btn-primary']) !!}
		</div>
	</div>







	{!! Form::close() !!}





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


</div>




</div>
</div>
</div>



@endsection