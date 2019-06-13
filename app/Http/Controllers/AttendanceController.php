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
	* /attendances/lessons/{lesson_id}
	* 
	* @param int $id
	* 
	* @return \Illuminate\Http\Response
	*/
	public function lessonAttendance($id = null)
	{
		$lesson = Lesson::findOrFail($id);

		if(Subject::userSubject($lesson->subject_id) && Group::userGroup($lesson->group_id)) {
			$subject = Subject::findOrFail($lesson->subject_id);
			$group = Group::findOrFail($lesson->group_id);
			
			return view('attendances.lesson')->with(compact('lesson', 'subject', 'group'));
		}else {
			abort(404);
		}
	}



	/**
	* Save attenndance
	* 
	* /attendances/save
	* 
	* @param  Request $request
	* 
	* @return \Illuminate\Http\Response
    */
	public function save(Request $request) {
		$attendance = new Attendance($request->all());
		$attendance->save();
		$student = Student::findOrFail($attendance->student_id);

		return response()->json(['success'=>'true', 'attendance'=>$attendance, 'student'=>$student]);
	}


	/**
	* Update attenndance
	* 
	* /attendances/{id}/update
	* 
	* @param  Request $request
	* 
	* @param  int $id
	* 
	* @return \Illuminate\Http\Response
    */
	public function update(Request $request, $id = null) {
		$attendance = Attendance::findOrFail($id);
		$attendance->status = $request->input('status');
		$attendance->update();
		$message = "Zapisano zmiany";
		$student = Student::findOrFail($attendance->student_id);

		return response()->json(['success'=>'true', 'attendance'=>$attendance, 'student'=>$student, 'message'=>$message]);
	}




}
