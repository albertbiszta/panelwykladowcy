@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

             <div class="card-header">

                <a href="{{route('groups.show', $group->id)}}"> <i class="fas fa-long-arrow-alt-left fa-lg"></i> 
                Wróć do grupy </a>
            </div>

            <div class="card-header">
                {!! Form::open(['route' => 'students.store']) !!}

                {!! Form::hidden('group_id', $group->id) !!}


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
                        {!! Form::label('indexNumber','Numer indeksu:') !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('indexNumber',null,['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        {!! Form::label('contact','Kontakt:') !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('contact',null,['class'=>'form-control']) !!}
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {!! Form::submit('Dodaj studenta',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>


                {!! Form::close() !!}



            </div>
        </div>
    </div>
</div>

@stop
