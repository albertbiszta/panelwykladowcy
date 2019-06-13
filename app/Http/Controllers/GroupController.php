<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Group;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{

	public function userGroup($id = null) 
	{
		if(Group::userGroup($id)) {
			$group = Group::findOrFail($id);
			return response()->json(['success'=>'true', 'group'=> $group->name]);
		} else {
			return response()->json(['error'=>'true']);
		}
	}



	public function index() 
	{
		$groups = User::find(Auth::user()->id)->groups;
		return view('groups.index')->with('groups', $groups); 
	}



	public function add(Request $request) 
	{
		$group = new Group($request->all());
		Auth::user()->groups()->save($group);
		$message = 'Dodano grupę';
		
		return response()->json(['success'=>$message, 'group' => $group]);

	}


	public function edit($id = null) 
	{
		if(Group::userGroup($id)) {
			$group = Group::findOrFail($id);
			return view('groups.edit')->with(compact('group'));
		} else {
			abort(404);	
		}
	}


	public function update(Request $request, $id = null) 
	{
		if(Group::userGroup($id)) {
			$group = Group::findOrFail($id);
			$group->update($request->all());
			$message = "Zapisano zmiany";
			return response()->json(['success'=>$message, 'group' => $group]);
		} 
	}


	public function delete($id = null) 
	{
		if(Group::userGroup($id)) {
			$group = Group::where(['id'=>$id])->delete();
			$message = "Usunięto grupę";
			return response()->json(['success'=>$message]);
		}else {
			$message = "Wystąpił błąd";
			return response()->json(['error'=>$message]);
		}
	}


	/**
	* /groups/{id}
	* Information about the group; Students belonging to this group
	*/
	public function show($id = null) 
	{ 
		if(Group::userGroup($id)) {
			$group = Group::findOrFail($id);
			$students = Group::find($id)->students;

			return view('groups.show')->with(compact('group', 'students'));
		} else {
			abort(404);	
		}
	}


}
