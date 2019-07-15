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

	/**
	 * List of groups + modals [Group CRUD]
	 * 
	 * /subjects
	 * 
     * @return \Illuminate\Http\Response
	*/
	public function index() 
	{
		$groups = User::find(Auth::user()->id)->groups;
		return view('groups.index')->with('groups', $groups); 
	}


	/**
	 * Save new group
	 * 
	 * /groups/store
	 * 
	 * @param  Request $request
	 * 
	 * @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$group = new Group($request->all());
		if(empty($request->input('contact'))){
			$group->contact = 'brak';
		}
		Auth::user()->groups()->save($group);
		$message = 'Dodano grupę';
		
		return response()->json(['success'=>$message, 'group' => $group]);
	}


	/**
	 * Update group data
	 * 
	 * /groups/{id}/update
     * 
	 * @param  Request $request
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id = null) 
	{
		if(Group::userGroup($id)) {
			$group = Group::findOrFail($id);
			$group->update($request->all());
			$message = "Zapisano zmiany";
			return response()->json(['success'=>$message, 'group' => $group]);
		} 
	}


	/**
	 * Delete group
	 * 
	 * /groups/{id}/delete
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
     */
	public function destroy($id = null)
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
	 * Details about group; Students belonging to this group
	 * 
	 * /groups/{id}
	 * 
	 * @param  int $id
	 * 
	 * @return \Illuminate\Http\Response
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

	/*?*/
	public function userGroup($id = null) 
	{
		if(Group::userGroup($id)) {
			$group = Group::findOrFail($id);
			return response()->json(['success'=>'true', 'group'=> $group->name]);
		} else {
			return response()->json(['error'=>'true']);
		}
	}


}
