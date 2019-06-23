<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Material;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{


	/**
	 * List of materials for students and uploading modal
	 * 
	 * /materials/
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$user = User::findOrFail(Auth::id());
		$subjects = $user->subjects()->get();
		$formSubjects = Subject::authSubjects();
		return view('materials.index')->with(compact('subjects', 'formSubjects'));
	}


	/**
	 * Store material
	 * /materials/store
	 * 
	 * @param Request $request
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		
		$file = $request->input('file');
		$filename = $request->file->getClientOriginalName();
		/*		$extension = $request->file->getClientOriginalExtension();*/

		if($request->hasFile('file')){

			$material = new Material;
			$material->name = $request->input('name');
			$material->description = $request->input('description');
			$material->fileName = rand(111,99999).$filename;
			$request->file->storeAs('materials', $material->fileName);
			$material->subject_id = $request->input('subject');
			$material->save();
			return redirect()->route('materials.index');

		}

		
	}


	/**
	 * Download material from storage
	 * 
	 * /materials/download/{name}
	 * 
	 * @param string $name
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function downloadFile($name)
	{
		return response()->download(storage_path("app/materials/{$name}"));
	}


	/**
	 * Delete material
	 * 
	 * /materials/{id}/delete
     *  
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
	 */

	public function delete($id = null)
	{
		$material = Material::findOrFail($id);
		$material->delete();
		/*$material = Material::where(['id'=>$id])->delete();*/
		unlink(storage_path('app/materials/'.$material->fileName));
		$message = "Usunięto materiał";
		return response()->json(['success'=>$message]);

	}




}
