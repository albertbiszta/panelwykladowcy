<?php

namespace App\Http\Controllers;

use App\Group;
use App\Subject;
use App\User;
use Auth;
use DB;
use Session;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

	public function index() 
	{
		$subjects = User::find(Auth::user()->id)->subjects;
		return view('subjects.index')->with('subjects', $subjects); 
	}


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


	public function edit($id = null) 
	{
		if(Subject::userSubject($id)) {
			$exam = Subject::examOptions();
			$subject = Subject::findOrFail($id);

			return view('subjects.edit')->with(compact('exam', 'subject'));
		}else {
			abort(404);	
		}
	}

	public function update(Request $request, $id = null) 
	{
		$subject = Subject::findOrFail($id);
		$subject->update($request->all());
		$message = "Zapisano zmiany";

		return redirect('subjects')->with('flash_message_success', $message);
	}


	public function destroy($id = null)
	{
		if(Subject::userSubject($id)) {
			$subject = Subject::where(['id'=>$id])->delete();
			$message = "Usunięto przedmiot";
			return redirect()->back()->with('flash_message_success', $message);
		}else {
			abort(404);	
		}
	}


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


	public function unassignGroup($subjectId, $groupId = null) 
	{
		if(Subject::userSubject($id)) {
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
