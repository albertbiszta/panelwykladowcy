<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Group;
use App\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    
 
    public function groupGrades($subjectId, $groupId = null)
    {
    	if(Subject::userSubject($subjectId) && Group::userGroup($groupId)) {
    		$subject = Subject::findOrFail($subjectId);
    		$group = Group::findOrFail($groupId);
    		return view('grades.group')->with(compact('subject', 'group'));

    	}else {
    		abort(404);
    	}
    }
 

    public function addGrade(Request $request, $subjectId = null) {
    	if(Subject::userSubject($subjectId)) {
    		$grade = new Grade;
    		$grade->value = $request->input('value');
    		$grade->student_id = $request->input('student');
    		$grade->subject_id = $subjectId;
    		$grade->save();
    		$message = "Dodano ocenę";

			return redirect()->back()->with('flash_message_success', $message);
    	}else {
    		abort(404);
    	}
    }


}
