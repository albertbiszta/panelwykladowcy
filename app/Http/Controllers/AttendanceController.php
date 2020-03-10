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
     * @param Lesson $lesson
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lessonAttendance(Lesson $lesson)
    {
        if ($lesson->subject->user == Auth::user() && $lesson->group->user == Auth::user()) {
            $subject = $lesson->subject;
            $group = $lesson->group;

            return view('attendances.lesson')->with(compact('lesson', 'subject', 'group'));
        } else {
            abort(404);
        }
    }


    /**
     * Save attenndance
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $attendance = new Attendance($request->all());
        $attendance->save();
        $student = $attendance->student;

        return response()->json(['success' => 'true', 'attendance' => $attendance, 'student' => $student]);
    }


    /**
     * Update attenndance
     *
     * @param Request $request
     * @param Attendance $attendance
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Attendance $attendance)
    {
        $attendance->status = $request->input('status');
        $attendance->update();
        $message = "Zapisano zmiany";
        $student = $attendance->student;

        return response()->json([
            'success' => 'true',
            'attendance' => $attendance,
            'student' => $student,
            'message' => $message,
        ]);
    }


}
