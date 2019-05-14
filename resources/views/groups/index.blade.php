@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<i href="/groups/create" class="fas fa-plus-circle fa-lg"></i>
					<a href="/groups/create">Dodaj grupę </a>
				</div>

				<div class="card-body">
					<table class="table table-borderless">
						<thead>
							<tr>
								<th scope="col">Nazwa Grupy</th>
								<th scope="col">Rok</th>
								<th scope="col">Kontakt do starosty</th>
								<th scope="col">Lista studentów</th>
								<th scope="col"><i class="fas fa-cog fa-lg"></i>
								


								</th>
								
							</tr>
						</thead>
						<tbody>


							@foreach($groups as $group)

							<tr>
								<td> {{$group->name}} </td>

								<td> {{$group->year}} </td>
								<td> {{$group->contact}}</td>
								<td>   <a href="{{ url('groups', $group->id) }}"> 
								
									<i class="far fa-address-card fa-lg" style="color: black"></i>

								 </a></td>
								

								<td>


									{!! Form::open(['action'=> ['GroupController@destroy', $group->id],
									'method'=>'POST', 'class' =>'form-horizontal']) !!}
									<a href="{{ route('groups.edit', $group->id) }}" class="btn btn-light btn-sm"><i class="far fa-edit fa-lg"></i></a>

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