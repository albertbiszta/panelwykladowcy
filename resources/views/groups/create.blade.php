@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                
             <div class="card-header">
                <a href="{{route('groups.index')}}"> <i class="fas fa-long-arrow-alt-left fa-lg"></i> 
                </a>



                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>

            <div class="card-header">

                <!-- Formularz -->
                {!! Form::open(['url'=>'groups', 'class' =>'form-horizontal']) !!}

                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        {!! Form::label('name','Nazwa:') !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div  class="col-md-4 control-label">
                        {!! Form::label('year','Rok:') !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('year',null,['class'=>'form-control']) !!}
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
                        {!! Form::submit('Dodaj grupę',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>







                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@stop
