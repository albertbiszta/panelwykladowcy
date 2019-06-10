<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Group;
use App\Lesson;
use App\Student;
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


	public function save(Request $request) {
		/*if(Subject::userSubject($lesson->subject_id) && Group::userGroup($student->group_id)) {*/
			$attendance = new Attendance($request->all());
			$attendance->save();

			$student = Student::findOrFail($attendance->student_id);

			return response()->json(['success'=>'true', 'attendance'=>$attendance, 'student'=>$student]);
		/*}*/

	}



}
