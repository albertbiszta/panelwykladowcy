@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
     <div class="card"  style="width: 65rem;" >

        <div class="card-header"><b> Twoje przedmioty </b></div>

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="card-body">

          @foreach($subjects as $subject)
          <h6><b> 
           <a href="{{ url('subjects', $subject->id) }}" style="color: black"> 
                                            {{$subject->name}}

                                        </a>
                                         </b></h6>

        <table class="table table-bordless table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Nazwa grupy</th>
                                    <th scope="col">Rok</th>
                                    <th scope="col">Lista studentów</th>
                                    <th scope="col">Oceny</th>
                                    <th scope="col">Zajęcia</th>


                                    </th>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach($subject->groups as $group)

                                <tr>

                                    <td> 
                                        <a href="{{ url('groups', $group->id) }}" style="color: black"> 
                                            {{$group->name}}

                                        </a>

                                    </td>


                                    <td> {{$group->year}} </td>
                                   <td>    <a href="{{ url('groups', $group->id) }}" > 
                                
                                    <i class="fas fa-user-graduate fa-lg" style="color: black"></i>

                                 </a></td>
                                    <td> 
                                        <a href="{{ action('GradeController@groupGrades', [$subject->id, $group->id]) }}" style="color: black"> 
                                          <i class="far fa-file-alt fa-lg" style="color: black"></i>

                                        </a>
                             


                                    </td>
                                    <td> 
                                        <a href="{{ action('LessonController@groupLessons', [$subject->id, $group->id]) }}" style="color: black"> 
                                          <i class="fas fa-chalkboard" style="color: black"></i>

                                        </a>

                                    </td>


                                  

                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>



          <br>

          @endforeach













            </div>


        </div>
    </div>
</div>
</div>
</div>
@endsection
