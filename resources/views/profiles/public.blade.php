@extends('layouts.app')
@section('content')



<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <b>  
            {{$user->lastName}}  {{$user->firstName}} 


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










        </div>
      </div>
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

    @endsection


