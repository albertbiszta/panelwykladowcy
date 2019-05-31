<?php

namespace App\Http\Controllers;

use App\Group;
use App\Lesson;
use App\Subject;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

	 /**
	* Attendance for lesson
	* 
	*@param int $lessonId
	* 
	*/
	public function lessonAttendance($lessonId = null)
	{
		$lesson = Lesson::findOrFail($lessonId);

		if(Subject::userSubject($lesson->subject_id) && Group::userGroup($lesson->group_id)) {
			$subject = Subject::findOrFail($lesson->subject_id);
			$group = Group::findOrFail($lesson->group_id);

			return view('attendances.lesson')->with(compact('lesson', 'subject', 'group'));
		}else {
			abort(404);
		}
	}


	public function saveAttendance(Request $request, $lessonId = null) {
		$lesson = Lesson::findOrFail($lessonId);

		if(Subject::userSubject($lesson->subject_id) && Group::userGroup($lesson->group_id)) {
		
		}else {
			abort(404);
		}

	}



}
