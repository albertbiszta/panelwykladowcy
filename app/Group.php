<?php

namespace App;

use Auth;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = ['name', 'year', 'contact'];

	public $timestamps = false;


	public function subjects() {
		return $this->belongsToMany('App\Subject');
	}

	public function students() {
		return $this->hasMany('App\Student');
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

	public static function authGroups() {
		$authGroups = User::find(Auth::user()->id)->groups;

	/*	$groups = array();
		foreach($authGroups as $group) {
			$groups[] =  [
				$group->id => $group->name,
			];
		}*/
		$groups = $authGroups->pluck('name', 'id');

		return $groups;
	}

}
