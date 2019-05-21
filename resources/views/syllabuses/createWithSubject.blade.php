@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header">

                 <div class="card-header">
                    <a href="{{route('syllabuses.index')}}"> <i class="fas fa-long-arrow-alt-left fa-lg"></i> 
                        <br> <b>Syllabus dla przedmiotu {{$subject->name}}</b>
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
                    {!! Form::open(['action'=> ['SyllabusController@storeWithSubject',
                    $subject->id],
                    'method'=>'POST', 'class' =>'form-horizontal']) !!}

                



                 <div class="form-group">
                    <div  class="col-md-4 control-label">
                        {!! Form::label('language','Język: ') !!}
                    </div>
                    <div class="col-md-6">

                       <select class="form-control" name="language" id="exampleFormControlSelect2">
                        <option value="" disable="true" selected="true"> Wybierz język </option>

                        <option value="Polski"> Polski </option>
                        <option value="Angielski"> Angielski </option>
                        <option value="Niemiecki"> Niemiecki </option>



                    </select>
                </div>
            </div>

            <div class="form-group">
                <div  class="col-md-4 control-label">
                    {!! Form::label('description','Opis:') !!}
                </div>
                <div class="col-md-6">
                    {!! Form::textarea('description',null,['class'=>'form-control','rows' => 8, 'cols' => 54]) !!}
                </div>
            </div>

            <div class="form-group">
                <div  class="col-md-4 control-label">
                    {!! Form::label('literature','Literatura:') !!}
                </div>
                <div class="col-md-6">
                    {!! Form::textarea('literature',null,['class'=>'form-control','rows' => 3, 'cols' => 54]) !!}
                </div>
            </div>



            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    {!! Form::submit('Dodaj sylabus',['class'=>'btn btn-primary']) !!}
                </div>
            </div>







            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>

@stop