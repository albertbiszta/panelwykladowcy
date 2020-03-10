<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Group;
use App\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{


    /**
     * Grades Index /w create, edit, delete
     *
     * @param Subject $subject
     * @param Group $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function groupGrades(Subject $subject, Group $group)
    {
        if ($subject->user == Auth::user() && $group->user == Auth::user()) {
            return view('grades.group')->with(compact('subject', 'group'));
        } else {
            abort(404);
        }
    }


    /**
     * Add grade
     *
     * /grades/add/subject/{subject_id}
     *
     * @param  Request $request
     *
     * @param  Subject $subject
     *
     * @return \Illuminate\Http\Response
     */
    public function addGrade(Request $request, Subject $subject)
    {
        if ($subject->user == Auth::user()) {
            $grade = new Grade;
            $grade->value = $request->input('value');
            if (!is_numeric($grade->value)) {
                $grade->value = preg_replace('~\D~', '', $grade->value);
            }

            $grade->student_id = $request->input('student');
            $grade->subject_id = $subject->id;
            $grade->save();
            $message = "Dodano ocenę";

            return redirect()->back()->with('flash_message_success', $message);
        } else {
            abort(404);
        }
    }


    /**
     * @param Request $request
     * @param Grade $grade
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Grade $grade)
    {
        $grade->value = $request->input('value');
        $grade->update();
        $message = 'Zapisano zmiany';

        return response()->json(['success' => $message]);
    }


    /**
     * @param Grade $grade
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        $message = 'Usunięto ocenę';

        return response()->json(['success' => $message]);
    }


}
