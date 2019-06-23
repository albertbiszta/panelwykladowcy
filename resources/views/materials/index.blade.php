@extends('layouts.app')
@section('content')



<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<b>  
						<a href=""  id="newMaterial" class="float-right" style="color: black" data-toggle="modal" data-target="#addMaterials">
							<i class="fas fa-plus-circle fa-lg"></i> Dodaj materiały 	</a>
						</b>

					</div>

					<div class="card-body">
						<div>
							<div class="alert alert-success alert-block"  id="success-info" style="display: none">
								<button type="button" class="close" data-dismiss="alert" >×</button> 
								<strong>
									<p id="info">
									</p>
								</strong>
							</div>

						</div>

						@if(count($subjects) > 0)

						@foreach($subjects as $subject)
							@if(count($subject->materials) > 0)


						<div class="card">
							<div class="card-header">
								<b> {{$subject->name}} </b>
							</div>
							<div class="card-body">
								<ul class="list-group list-group-flush">



									@foreach($subject->materials as $material)





									<li class="list-group-item mh-25">{{$material->name}}   
									  <a  href="{{route('materials.download', [$material->fileName])}}" class="float-right mh-25" > 
										<button class="btn btn-outline-secondary button-1 mh-25" >Pobierz</button>

									</a>  
									  </li>









									@endforeach

								</ul>
							</div>
						</div>
						<br> 




				@endif
						@endforeach

						@endif

						


			{{-- 			@if(count($subjects) > 0)

						@foreach($subjects as $subject)
						<table class="table table-bordered table-sm table-responsive-sm">

							<div class="card" style="width: 18rem;">
								<ul class="list-group list-group-flush">






									@foreach($subject->materials as $material)

									<li class="list-group-item">  	{{$material->name}} 


										<a  href="{{route('materials.download', [$material->fileName])}}"> Pobierz </a>  
									</li>









									@endforeach


								</ul>
							</div>

							@endforeach

							@endif

						</div>
						--}}



						{{-- add modal --}}
						<div class="modal fade" id="addMaterials" tabindex="-1" role="dialog" data-dismiss="modal" aria-label="Close">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Udostępnij materiały</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"><span >&times;</span></button>

									</div>


									<div class="modal-body">
										<div class="alert alert-danger alert-block"  id="validation-info" style="display:none">

										</div>



										{!! Form::open(['route' => 'materials.store', 'files'=>true]) !!}





										<div class="form-group">
											<div  class="col-md-8 control-label">
												{!! Form::label('name','Nazwa: ') !!}
											</div>
											<div class="col-md-8">
												{!! Form::text('name',null,['class'=>'form-control'

												]) !!}
											</div>
										</div>


										<div class="form-group ">
											<div  class="col-md-4 control-label">
												{!! Form::label('subject','Przedmiot: ') !!}
											</div>
											<div  class="col-md-8">

												<select class="form-control" name="subject" id="exampleFormControlSelect2">
													<option value="" disable="true" selected="true"> Wybierz przedmiot </option>
													@foreach($formSubjects as $key => $value)


													<option value="{{$key}}">{{$value}} </option>


													@endforeach
												</select>


											</div>
										</div>






										<div class="form-group">
											<div  class="col-md-8 control-label">
												{!! Form::label('description','Opis:') !!}
											</div>
											<div class="col-md-8">
												{!! Form::textarea('description',null,['class'=>'form-control','rows' => 4, 'cols' => 32]) !!}
											</div>
										</div>


										<div class="form-group">
											<div  class="col-md-8 control-label">

											</div>
											<div class="col-md-8">
												<input type="file" class="custom-file-input form-control" id="file" name="file">
												<label class="custom-file-label" for="file">Wybierz plik</label>
											</div>
										</div>

										<div class="form-group  float-right">
											<div class="col-md-6 col-md-offset-4">

												<div class="form-group">
													<div class="col-md-6 col-md-offset-4">
														{!! Form::submit('Udostępnij',['class'=>'btn btn-outline-secondary float-right']) !!}

													</div>
												</div>




											</div>
										</div>

										{!! Form::close() !!}


									</div>
									<div class="modal-footer">

									</div>


								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->

						{{--  --}}







						{{-- confirm delete modal --}}

						<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">

									<div class="modal-header">
										<h4 class="modal-title">Czy na pewno chcesz usunąć ten przedmiot?</h4>


										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<button type="button" id="confirm-delete-subject" class="btn btn-outline-danger float-right"
										data-dismiss="modal">Tak</button>
									</div>


								</div>
							</div>
						</div>

						{{--  --}}



					</div>
				</div>
			</div>
			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

			@endsection


