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

	public function index() {
		$subjects = User::find(Auth::user()->id)->subjects;

		return view('subjects.index')->with('subjects', $subjects); 
	}

	public function create() {
		$exam = Subject::examOptions();

		return view('subjects.create')->with('exam',$exam);
	}

	public function store(Request $request) {
		$subject = new Subject($request->all());
		Auth::user()->subjects()->save($subject);
		$message = "Dodano przedmiot";

		return redirect('subjects')->with('flash_message_success', $message);
	}

	public function edit($id) {
		if(!empty($id)) {
			$exam = Subject::examOptions();
			$subject = Subject::findOrFail($id);

			return view('subjects.edit')->with(compact('exam', 'subject'));
		}
	}

	public function update(Request $request, $id) {
		if(!empty($id)) {

			$subject = Subject::findOrFail($id);
			$subject->update($request->all());
			$message = "Zapisano zmiany";

			return redirect('subjects')->with('flash_message_success', $message);
		}
	}



	public function destroy($id) {
		if(!empty($id))	{
			$subject = Subject::where(['id'=>$id])->delete();
			$message = "Usunięto przedmiot";

			return redirect()->back()->with('flash_message_success', $message);
		}
	}

	public function show($id) {
		if(!empty($id)) {
			$groups = Group::authGroups();
			$subject = Subject::findOrFail($id);

			return view('subjects.show')->with(compact('groups', 'subject'));
		}
	}

	public function assignGroup(Request $request, $id) {
		if(!empty($id)) {
			$subject = Subject::findOrFail($id);
			$groups = $request->input('groups');
			$subject->groups()->attach($groups);
			$message = "Dodano grupę do przedmiotu";

			return redirect()->back()->with('flash_message_success', $message);
		}
	}


	public function unassignGroup($subjectId, $groupId) {
		
		if(!empty($subjectId) && !empty($groupId)) {
			$subject = Subject::findOrFail($subjectId);
			$group = Group::findOrFail($groupId);
			$subject->groups()->detach($group);
			$message = "Usunięto grupę z przedmiotu";

			return redirect()->back()->with('flash_message_success', $message);
		}
	
	}



}
