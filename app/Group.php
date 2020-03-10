<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = ['name', 'contact'];

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
		return $this->hasMany('App\Student')->orderBy('last_name');
	}


	public function user() 
	{
		return $this->belongsTo('App\User');
	}


}
