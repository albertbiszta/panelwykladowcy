<?php

namespace App\Http\Controllers;

use App\User;
use App\Subject;
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

		return redirect('subjects');
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




}
