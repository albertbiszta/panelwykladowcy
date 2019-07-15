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
     * Search students view
     *  /students
     */

    public function index()
    {
        return view('students.index');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');
        $data = explode(' ', $query);

        $students = Student::where('first_name', 'LIKE', '%' . $data[0] . '%')->where('last_name', 'LIKE', '%' . $data[1] . '%')->get();
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
     * /students/store'
     *
     * @param  Request $request
     *
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
     * /students/{id}/update
     *
     * @param  Request $request
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        if (Student::userStudent($id)) {
            $student = Student::findOrFail($id);
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
     * Delete student
     *
     * /students/{id}/delete
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function destroy($id = null)
    {
        if (Student::userStudent($id)) {
            $student = Student::where(['id' => $id])->delete();
            $message = "Usunięto studenta";
            return response()->json(['success' => $message]);
        } else {
            $message = "Wystąpił błąd";
            return response()->json(['error' => $message]);
        }
    }


}
