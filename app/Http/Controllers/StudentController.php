<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Session;
use App\Group;
use App\Student;
use App\User;
use Illuminate\Http\Request;


class StudentController extends Controller
{


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('students.index');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        $data = explode(' ', $query);

        $students = Student::where('first_name', 'LIKE', '%'.$data[0].'%')->where('last_name', 'LIKE',
            '%'.$data[1].'%')->get();
        if (count($students) > 0) {
            return response()->json(['students' => $students]);

        } else {
            $message = "Student nie istnieje";

            return response()->json(['error' => $message]);
        }
    }


    /**
     * Add new student to group
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $groupId = $request->get('group_id');

        $student = new Student($request->all());
        if (is_null($request->get('contact'))) {
            $student->contact = '';
        }
        $student->group()->associate($groupId);
        $student->save();
        $message = "Dodano studenta do grupy";

        return response()->json(['success' => $message, 'student' => $student]);

    }


    /**
     * Update student data
     *
     * @param  Request $request
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        if ($student->subject->user == Auth::user()) {
            $groupId = $request->input('group_id');
            if (is_null($request->get('contact'))) {
                $student->contact = '';
            }
            $student->group()->associate($groupId);
            $student->update($request->all());

            $message = "Zapisano zmiany";

            return response()->json(['success' => $message, 'student' => $student]);
        }

    }


    /**
     * @param Student $student
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Student $student)
    {
        if ($student->subject->user == Auth::user()) {
            $student->delete();
            $message = "Usunięto studenta";

            return response()->json(['success' => $message]);
        } else {
            $message = "Wystąpił błąd";

            return response()->json(['error' => $message]);
        }
    }


    /**
     * Student info
     *
     * @param Student $student
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Student $student)
    {
        if ($student->subject->user == Auth::user()) {
            return view('students.show')->with(compact('student'));

        } else {
            abort(404);
        }

    }


}
