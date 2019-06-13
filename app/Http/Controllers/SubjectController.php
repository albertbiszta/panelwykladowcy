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
	 * /subjects
	 * 
     * @return \Illuminate\Http\Response
	*/
	public function index() 
	{
		$exam = Subject::examOptions();
		$subjects = User::find(Auth::user()->id)->subjects;
		return view('subjects.index', compact('exam', 'subjects')); 
	}


	/**
	 * Save new subject
	 * 
	 * /subjects/add
	 * 
	 * @param  Request $request
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function add(Request $request) 
	{
		$subject = new Subject($request->all());
		Auth::user()->subjects()->save($subject);
		$message = "Dodano przedmiot";
		return response()->json(['success'=>$message, 'subject' => $subject]);
	}


	/**
	 * Update subject data
	 * 
	 * /subjects/{id}/update
     * 
	 * @param  Request $request
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
     */
	public function update(Request $request, $id = null) 
	{
		if(Subject::userSubject($id)) {
			$subject = Subject::findOrFail($id);
			$subject->update($request->all());
			$message = "Zapisano zmiany";

			return response()->json(['success'=>$message, 'subject' => $subject]);
		}
	}


	/**
	 * Delete subject
	 * 
	 * /subjects/{id}/delete
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
     */
	public function delete($id = null)
	{
		if(Subject::userSubject($id)) {
			$subject = Subject::where(['id'=>$id])->delete();
			$message = "Usunięto przedmiot";
			return response()->json(['success'=>$message]);
		}else {
			$message = "Wystąpił błąd";
			return response()->json(['error'=>$message]);
		}
	}


	/**
	 * Details about subject: groups, syllabuses
	 * 
	 * /subjects/{id}
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function show($id = null) 
	{ 
		if(Subject::userSubject($id)) {
			$groups = Group::authGroups();
			$subject = Subject::findOrFail($id);
			return view('subjects.show')->with(compact('groups', 'subject'));
		}else {
			abort(404);	
		}
	}


	/*?*/
	public function subjectGroups($id = null)
	{
		$subject = Subject::findOrFail($id);
		$subjectGroups = $subjects->groups()->get();

		/*return response()->json(['subjectGroups'=>$subjectGroups]);*/
		return response()->json(['success'=>'test']);
	}


	/**
	 *  Assign group to subject
	 * 
	 * /subjects/{id}/assign-group
	 * 
	 * @param  Request $request
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function assignGroup(Request $request, $id = null) 
	{
		if(Subject::userSubject($id)) {
			$subject = Subject::findOrFail($id);
			$groups = $request->input('groups');
			$subject->groups()->attach($groups);
			$message = "Dodano grupę do przedmiotu";
			return redirect()->back()->with('flash_message_success', $message);
		}else {
			abort(404);	
		}	
	}


	/**
	 * Unassign group from subject
	 * 
	 * /subjects/{id}/unassign-group
	 * 
	 * @param  int $subjectId
	 * 
	 * @param  int $groupId
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function unassignGroup($subjectId, $groupId = null) 
	{
		if(Subject::userSubject($subjectId)) {
			$subject = Subject::findOrFail($subjectId);
			$group = Group::findOrFail($groupId);
			$subject->groups()->detach($group);
			$message = "Usunięto grupę z przedmiotu";
			return redirect()->back()->with('flash_message_success', $message);
		}else {
			abort(404);	
		}
	}



}
