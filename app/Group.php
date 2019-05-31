<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = ['name', 'year', 'contact'];

	public $timestamps = false;



	public function lessons()
	{
		 return $this->hasMany('App\Lesson');
	}


	public function subjects() 
	{
		return $this->belongsToMany('App\Subject');
	}


	public function students() 
	{
		return $this->hasMany('App\Student');
	}


	public function user() 
	{
		return $this->belongsTo('App\User');
	}


    /**
	* Auth User groups list with group name and id as value
	*/
	protected function authGroups() 
	{
		$authGroups = User::find(Auth::user()->id)->groups;
		$groups = $authGroups->pluck('name', 'id');

		return $groups;
	}


	/**
	* if this group belongs to auth user
	* 
	*@param int $groupId
	* 
	*@return bool
	*/
	protected function userGroup($groupId = null): bool
	{
		$group = Group::findOrFail($groupId);
		if($group->user_id == Auth::user()->id) {
			return true;
		} else {
			return false;
		}
	}


}
