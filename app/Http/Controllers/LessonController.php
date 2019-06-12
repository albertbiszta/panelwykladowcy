<?php

namespace App\Http\Controllers;

use Auth;
use App\Group;
use App\Lesson;
use App\Subject;
use App\User;
use Illuminate\Http\Request;

class LessonController extends Controller
{

    /**
     * List of user's lessons
     * 
     * /lessons
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $subjects = User::find(Auth::user()->id)->subjects;

       return view('lessons.index')->with(compact('subjects'));
    }




    public function groupLessons($subjectId, $groupId = null)
    {
      if(Subject::userSubject($subjectId) && Group::userGroup($groupId)) {
         $subject = Subject::findOrFail($subjectId);
         $group = Group::findOrFail($groupId);


         return view('lessons.group')->with(compact('subject', 'group'));

     }else {
         abort(404);
     }
 }


 public function add(Request $request, $subjectId, $groupId = null) {
    if(Subject::userSubject($subjectId) && Group::userGroup($groupId)) {
        $lesson = new Lesson;
        $lesson->subject_id = $subjectId;
        $lesson->group_id = $groupId;
        $lesson->topic = $request->input('topic');
        $lesson->performed = $request->input('performed');
        $lesson->date = $request->input('date');
        $lesson->save();
        $message = "Dodano lekcję";
        return redirect()->back()->with('flash_message_success', $message);
    }else {
        abort(404);
    }
}


public function editStatus(Request $request, $id = null) {
    $lesson = Lesson::findOrFail($id);
    $lesson->performed = $request->input('performed');
    $lesson->update();
    $message = "Zmieniono status zajęć";


    return redirect()->back()->with('flash_message_success', $message);
}





}
