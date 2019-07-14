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


	/**
	 * Add syllabus form
	 * 
	 * /subjects/{id}/add-syllabus
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function create($id = null)
	{
		if(Subject::userSubject($id)) {
			$subject = Subject::findOrFail($id);
			return view('syllabuses.create')->with(compact('subject'));
		}else {
			abort(404);	
		}
	}


	/**
	 * Save syllabus
	 * 
	 * /subjects/{id}/syllabus/store
	 * 
	 * @param  Request $request
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function store(Request $request, $id = null)
	{
		if(Subject::userSubject($id)) {
			$syllabus = new Syllabus($request->all());
			$syllabus->subject()->associate($id);
			$syllabus->save();
			$message = "Dodano syllabus";

			return redirect()->route('subjects.show', [$id])->with('flash_message_success', $message); 
		}else {
			abort(404);	
		}
		
	}


   /**
   * Delete syllabus
   * 
   * /syllabuses/{id}/delete
   * 
   * @param  int $id
   * 
   * @return \Illuminate\Http\Response
    */
   public function delete($id = null) 
   {
   	$syllabus = Syllabus::findOrFail($id);
   	if(Subject::userSubject($syllabus->subject_id)){
   		$syllabus->delete();
   		$message = 'Usunięto syllabus';
   		return response()->json(['success'=>$message]);
   	}

   }


   /**
	 * Edit syllabus form
	 * 
	 * /syllabuses/{id}/edit
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
	 */

   public function edit($id = null)
   {
   	$syllabus = Syllabus::findOrFail($id);
   	if(Subject::userSubject($syllabus->subject_id)){
   		return view('syllabuses.edit')->with(compact('syllabus'));
   	}else {
   		abort(404);	
   	}
   }

   /**
	 * update syllabus
	 * 
	 * /syllabuses/{id}/update
	 * 
	 * @param  Request $request
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id = null)
	{
		$syllabus = Syllabus::findOrFail($id);
   	      if(Subject::userSubject($syllabus->subject_id)){
			$syllabus->update($request->all());

			$message = "Zapisano zmiany";

			return redirect()->route('subjects.show', [$syllabus->subject_id])->with('flash_message_success', $message); 
		}else {
			abort(404);	
		}
		
	}






}
