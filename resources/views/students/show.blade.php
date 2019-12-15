@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <h5 id="group-header">
                            <b> {{$student->last_name}} {{$student->first_name}} </b>
                            <div class="float-right">


                            </div>

                        </h5>
                    </div>

                    <div class="card-header">


                        <br>


                        <div class="card-body">
                            <div>
                                <div class="alert alert-success alert-block" id="success-info" style="display: none">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>
                                        <p id="info">
                                        </p>
                                    </strong>
                                </div>

                            </div>
                            <div class="card">


                                <ul class="list-group list-group-flush">


                                    <li class="list-group-item mh-25"> Nazwisko i imię:
                                        <b> {{$student->last_name}} {{ $student->first_name}}</b>

                                    </li>

                                    <li class="list-group-item mh-25">
                                        Grupa:
                                        <a href="{{ url('groups', $student->group_id) }}">

                                            <b> {{$student->group->name}} </b>

                                        </a>

                                    </li>

                                    <li class="list-group-item mh-25"> Numer indeksu:
                                        <b> {{ $student->index_number}}</b>

                                    </li>

                                    <li class="list-group-item mh-25"> Kontakt:
                                        <b> {{ $student->contact}}</b>

                                    </li>




                                </ul>
                            </div>
                        </div>
                        <br>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

@endsection