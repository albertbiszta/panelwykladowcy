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

	/**
	* Search students view
	*  /students
	*/

	public function index() 
	{
		return view('students.index'); 
	}


	public function search(Request $request)
	{
		$query = $request->get('query');
		$data = explode(' ', $query);
/*		$firstname = $data[0];
		$lastname = $data[1];*/
		$students = Student::where('firstname', 'LIKE', '%'.$data[0].'%')->where('lastname', 'LIKE', '%'.$data[1].'%')->get();
		if(count($students) > 0) {
			return view('students.search-results')->with(compact('students'));
		} else {
			$message = "Student nie istnieje";
			return redirect()->back()->with('flash_message_error', $message);
		}

		
	}


	public function create($id = null)
	{
		$group = Group::findOrFail($id);

		return view('students.create')->with(compact('group'));
	}


	public function store(Request $request) 
	{
		$student = new Student($request->all());
		$student->group()->associate($request->input('group_id'));
		$student->save();
		
		$message = "Dodano studenta do grupy";

		return redirect()->back()->with('flash_message_success', $message); 
	}


	public function edit($id = null) 
	{
		if(Student::userStudent($id)) {
			$groups = Group::authGroups();
			$student = Student::findOrFail($id);
			return view('students.edit')->with(compact('groups', 'student'));
		}else {
			abort(404);	
		}
	}


	public function update(Request $request, $id = null) 
	{
		$student = Student::findOrFail($id);
		$groupId = $request->input('group_id');
		$student->group()->associate($groupId);
		$student->update($request->all());

		$message = "Zapisano zmiany";

		/*return redirect('groups.show', $request->input('group_id'))->with('flash_message_success', $message);*/
		return redirect()->route('groups.show', $groupId)->with('flash_message_success', $message);
	}


	public function destroy($id = null)
	{
		if(Student::userStudent($id)) {
			$student = Student::where(['id'=>$id])->delete();
			$message = "Usunięto studenta";

			return redirect()->back()->with('flash_message_success', $message);
		}else {
			abort(404);	
		}
	}


}
