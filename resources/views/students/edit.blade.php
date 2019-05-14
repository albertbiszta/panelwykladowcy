
@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
             <div class="card-header">


                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Formularz -->

                {!! Form::model($student, ['method'=>'PATCH','class'=>'form-horizontal',
                'action'=>['StudentController@update', $student->id]]) !!}

                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        {!! Form::label('firstname','Imię:') !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('firstname',null,['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        {!! Form::label('lastname','Nazwisko:') !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('lastname',null,['class'=>'form-control']) !!}
                    </div>
                </div>


                <div class="form-group">
                    <div  class="col-md-4 control-label">
                      {!! Form::label('group_id','Grupa:') !!}
                  </div>
                  <div class="col-md-6">
    

                        <select class="form-control" name="group_id" id="exampleFormControlSelect2">
                        <option value="" disable="true" selected="true"> Wybierz grupę </option>
                        @foreach($groups as $key => $value)

                        <option value="{{$key}}">{{$value}} </option>

                        @endforeach
                    </select>


                </div>
            </div>




            <div class="form-group">
                <div  class="col-md-4 control-label">
                    {!! Form::label('contact','Kontakt do przedstawiciela:') !!}
                </div>
                <div class="col-md-6">
                    {!! Form::text('contact',null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    {!! Form::submit('Zapisz zmiany',['class'=>'btn btn-primary']) !!}
                </div>
            </div>







            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>

@stop