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
	 * /subjects/create
	*/
	public function create() 
	{
		$exam = Subject::examOptions();
		return view('subjects.create')->with('exam',$exam);
	}


	public function store(Request $request) 
	{
		$subject = new Subject($request->all());
		Auth::user()->subjects()->save($subject);
		$message = "Dodano przedmiot";
		return redirect('subjects')->with('flash_message_success', $message);
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



		public function editModal(Request $request) 
		{
			$subject = Subject::findOrFail($request->id);
			$subject->update($request->all());
			$message = "Zapisano zmiany";

			return response()->json(['success'=>$message, 'subject' => $subject]);
		}


		/*public function edit($id = null) 
		{
			if(Subject::userSubject($id)) {
				$exam = Subject::examOptions();
				$subject = Subject::findOrFail($id);

				return view('subjects.edit')->with(compact('exam', 'subject'));
			}else {
				abort(404);	
			}
		}*/

		public function update(Request $request) 
		{
			$id = $request->input('subject_id');
			if(Subject::userSubject($id)) {
				$subject = Subject::findOrFail($id);
				$subject->update($request->all());
				$message = "Zapisano zmiany";
				
				return response()->json(['success'=>$message, 'subject' => $subject]);
			}
		}


	/**
	 * /subjects/{id}/delete
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
	 *  Details about subject: groups, syllabuses
	 * 
	 * /subjects/{id}
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


	public function subjectGroups($id = null)
	{
		$subject = Subject::findOrFail($id);
		$subjectGroups = $subjects->groups()->get();

		/*return response()->json(['subjectGroups'=>$subjectGroups]);*/
		return response()->json(['success'=>'test']);
	}


	/**
	 * /subjects/{id}/assign-group
	 *  AJAX
	*/
/*	public function assignGroup(Request $request, $id = null) 
	{
		if(Subject::userSubject($id)) {
			$subject = Subject::findOrFail($id);
			$groups = $request->input('group');
			$subject->groups()->attach($groups);

			$group = Group::findOrFail($groups);
			$message = "Dodano grupę do przedmiotu";

			return response()->json(['success'=>$message, 'group'=> $group]);

		}else {
			$message = "Wystąpił błąd";
			return response()->json(['error'=>$message]);
		}
	}
*/

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
	 * Unassign group to subject
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
