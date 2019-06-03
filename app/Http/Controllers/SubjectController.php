<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Session;
use App\Group;
use App\Subject;
use App\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

	public function index() 
	{
		$exam = Subject::examOptions();
		$subjects = User::find(Auth::user()->id)->subjects;
		return view('subjects.index', compact('exam', 'subjects')); 
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
		return response()->json(['success'=>$message]);

		/*	return redirect('subjects')->with('flash_message_success', $message);*/
	}
	

	public function storeModal(Request $request) 
	{
		$subject = new Subject($request->all());
		Auth::user()->subjects()->save($subject);
		$message = "Dodano przedmiot";
		return response()->json(['success'=>$message, 'subject' => $subject]);

		/*	return redirect('subjects')->with('flash_message_success', $message);*/
	}


	public function editModal(Request $request) 
	{
		$subject = Subject::findOrFail($request->id);
		$subject->update($request->all());
		$message = "Zapisano zmiany";

		return response()->json(['success'=>$message, 'subject' => $subject]);
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
		if(Subject::userSubject($id)) {
			$subject = Subject::findOrFail($id);
			$subject->update($request->all());
			$message = "Zapisano zmiany";
			return response()->json(['success'=>$message, 'subject' => $subject]);
		}
		

	}


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


	public function unassignGroup($subjectId, $groupId = null) 
	{
		if(Subject::userSubject($subjectId)) {
			$subject = Subject::findOrFail($subjectId);
			$group = Group::findOrFail($groupId);
			$subject->groups()->detach($group);
			$message = "Usunięto grupę z przedmiotu";

			return response()->json(['success'=>$message]);
		}else {
			$message = "Wystąpił błąd";
			return response()->json(['error'=>$message]);
		}
	}



}
