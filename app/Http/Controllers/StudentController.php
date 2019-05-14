<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Session;
use App\Group;
use App\Student;
use App\User;
use Illuminate\Http\Request;


class StudentController extends Controller
{

	public function create($id) {
		if(!empty($id)) {
			$group = Group::findOrFail($id);

			return view('students.create')->with(compact('group'));
		}
	}

	public function store(Request $request) {
		$student = new Student($request->all());
		$student->group()->associate($request->input('group_id'));
		$student->save();
		
		$message = "Dodano studenta do grupy";

		return redirect()->back()->with('flash_message_success', $message); 
	}

	public function edit($id) {
		if(!empty($id)) {
			$groups = Group::authGroups();
			$student = Student::findOrFail($id);

			return view('students.edit')->with(compact('groups', 'student'));
		}
	}

	public function update(Request $request, $id) {
		if(!empty($id)) {

			$student = Student::findOrFail($id);
			$student->update($request->all());
		/*	$groupId = $request->input('group_id');
			$student->group()->associate($groupId);*/
			$message = "Zapisano zmiany";

			return redirect('groups.show', $request->input('group_id'))->with('flash_message_success', $message);
		}
	}



	public function destroy($id) {
		if(!empty($id))	{
			$student = Student::where(['id'=>$id])->delete();
			$message = "Usunięto studenta";

			return redirect()->back()->with('flash_message_success', $message);
		}
	}


}
