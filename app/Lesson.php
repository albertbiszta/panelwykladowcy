<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

	protected $fillable = ['date', 'description', 'performed'];
	
	protected $dates = ['date'];

	public $timestamps = false;


	public function group()
	{
		return $this->belongsTo('App\Group');
	}


	public function subject()
	{
		return $this->belongsTo('App\Subject');
	}

}
