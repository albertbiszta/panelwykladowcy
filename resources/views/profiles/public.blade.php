@extends('layouts.guest')
@section('content')


    <div class="container">
        @if(Auth::check())
            <a href="{{ url()->previous() }}" style="color: black">
                <i class="far fa-arrow-alt-circle-left  fa-lg"></i> Wróć do panelu    </a>
            <br> <br>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">

                        <b>
                            {{$user->last_name}}  {{$user->first_name}}

                        </b>
                        ({{$user->university}})

                    </div>


                    <div class="card-body">



                      <h5><b>Udostępnione materiały</b> </h5>

                        <div class="card-body">
                            <div class="alert alert-success alert-block" id="success-info"
                                 style="display: none">
                                <button type="button" class="close" data-dismiss="alert">×</button>
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
                                        <div class="card-body">
                                            <div class="card-header">
                                                <b> {{$subject->name}} </b>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">


                                                    @foreach($subject->materials as $material)





                                                        <li class="list-group-item mh-25">{{$material->name}}
                                                            <a href="{{route('materials.download', [$material->file_name])}}"
                                                               class="float-right mh-25">
                                                                <button class="btn btn-outline-secondary button-1 mh-25">
                                                                    Pobierz
                                                                </button>

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




