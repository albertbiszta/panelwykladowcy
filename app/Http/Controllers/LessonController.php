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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = User::find(Auth::user()->id)->subjects;

        return view('lessons.index')->with(compact('subjects'));
    }


    /**
     * @param Subject $subject
     * @param Group $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function groupLessons(Subject $subject, Group $group)
    {
        if ($subject->user == Auth::user() && $group->user == Auth::user()) {

            return view('lessons.group')->with(compact('subject', 'group'));

        } else {
            abort(404);
        }
    }


    /**
     * @param Request $request
     * @param Subject $subject
     * @param Group $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Subject $subject, Group $group)
    {
        if ($subject->user == Auth::user() && $group->user == Auth::user()) {
            $lesson = new Lesson;
            $lesson->subject_id = $subject->id;
            $lesson->group_id = $group->id;
            $lesson->topic = $request->input('topic');
            $lesson->performed = $request->input('performed');
            $lesson->date = $request->input('date');
            $lesson->save();
            $message = "Dodano lekcję";

            return redirect()->back()->with('flash_message_success', $message);
        } else {
            abort(404);
        }
    }


    /**
     * @param Request $request
     * @param Lesson $lesson
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editStatus(Request $request, Lesson $lesson)
    {
        $lesson->performed = $request->input('performed');
        $lesson->update();
        $message = "Zmieniono status zajęć";


        return redirect()->back()->with('flash_message_success', $message);
    }


}
