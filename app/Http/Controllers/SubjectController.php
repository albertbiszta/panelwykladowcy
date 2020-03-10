<?php

namespace App\Http\Controllers;

use Auth;
use App\Group;
use App\Subject;
use App\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    /**
     * List of subjects + modals [Subject CRUD]
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = User::find(Auth::user()->id)->subjects;

        return view('subjects.index', compact('subjects'));
    }


    /**
     * Save new subject
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = new Subject($request->all());
        Auth::user()->subjects()->save($subject);
        $message = "Dodano przedmiot";

        return response()->json(['success' => $message, 'subject' => $subject]);
    }


    /**
     * Update subject data
     *
     * @param Request $request
     * @param Subject $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Subject $subject)
    {
        if ($subject->user == Auth::user()) {
            $subject->update($request->all());
            $message = "Zapisano zmiany";

            return response()->json(['success' => $message, 'subject' => $subject]);
        }
    }


    /**
     * Delete subject
     *
     * @param Subject $subject
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Subject $subject)
    {
        if ($subject->user == Auth::user()) {
            $subject->delete();
            $message = "Usunięto przedmiot";

            return response()->json(['success' => $message]);
        } else {
            $message = "Wystąpił błąd";

            return response()->json(['error' => $message]);
        }
    }


    /**
     * Details about subject: groups, syllabuses
     *
     * @param  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        if ($subject->user == Auth::user()) {
            $groups = Auth::user()->groups;

            return view('subjects.show')->with(compact('groups', 'subject'));
        } else {
            abort(404);
        }
    }


    /**
     * @param Subject $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function subjectGroups(Subject $subject)
    {
        $subjectGroups = $subject->groups;

        return response()->json(['success' => 'test']);
    }


    /**
     * Assign group to subject
     *
     * @param Request $request
     * @param Subject $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignGroup(Request $request, Subject $subject)
    {
        if ($subject->user == Auth::user()) {
            $groups = $request->input('groups');
            $subject->groups()->attach($groups);
            $message = "Dodano grupę do przedmiotu";

            return redirect()->back()->with('flash_message_success', $message);
        } else {
            abort(404);
        }
    }


    /**
     * Unassign group from subject
     *
     * @param Subject $subject
     * @param Group $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unassignGroup(Subject $subject, Group $group)
    {
        if ($subject->user == Auth::user()) {
            $subject->groups()->detach($group);
            $message = "Usunięto grupę z przedmiotu";

            return redirect()->back()->with('flash_message_success', $message);
        } else {
            abort(404);
        }
    }


}
