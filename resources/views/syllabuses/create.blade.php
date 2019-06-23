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

</div>
            <div class="card-header">


{!! Form::open(['route' => 'syllabuses.store']) !!}


<div class="form-group ">
   <div  class="col-md-4 control-label">
       {!! Form::label('subject','Przedmiot: ') !!}
   </div>
   <div  class="col-md-6">

       <select class="form-control" name="subject" id="exampleFormControlSelect2">
           <option value="" disable="true" selected="true"> Wybierz przedmiot </option>
           @foreach($subjects as $key => $value)


           <option value="{{$key}}">{{$value}} </option>


           @endforeach
       </select>


   </div>
</div>








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
   {!! Form::textarea('description',null,['class'=>'form-control','rows' => 6, 'cols' => 44]) !!}
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
   {!! Form::submit('Dodaj sylabus',['class'=>'btn btn-outline-secondary float-right']) !!}
  </div>
</div>



                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@stop
