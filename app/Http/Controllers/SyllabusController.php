<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Session;
use App\Subject;
use App\Syllabus;
use App\User;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{


	public function index()
	{
		return view('syllabuses.index');
	}


	public function create()
	{
		$subjects = Subject::authSubjects();
		return view('syllabuses.create')->with(compact('subjects'));
	}



	public function store(Request $request)
	{
		$syllabus = new Syllabus($request->all());
		$subject = $request->input('subject');
		$syllabus->subject()->associate($subject);
		$syllabus->save();
		$message = "Dodano syllabus";

		return redirect()->route('subjects.show', [$subject])->with('flash_message_success', $message); 

	}



	public function addWithSubject($id = null)
	{
		if(Subject::userSubject($id)) {
			$subject = Subject::findOrFail($id);
			return view('syllabuses.createWithSubject')->with(compact('subjects'));
		}else {
			abort(404);	
		}
		
	}


	public function saveWithSubject(Request $request, $id = null)
	{
			if(Subject::userSubject($id)) {
				$syllabus = new Syllabus($request->all());
				$subject = Subject::findOrFail($id);
				$syllabus->subject()->associate($subject);
				$syllabus->save();
				$message = "Dodano syllabus";

				return redirect()->route('subjects.show', [$id])->with('flash_message_success', $message); 
			}else {
				abort(404);	
			}	
	}




}
