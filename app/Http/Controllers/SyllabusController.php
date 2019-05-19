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

		return redirect()->route('syllabuses.index')->with('flash_message_success', $message); 
	}


}
