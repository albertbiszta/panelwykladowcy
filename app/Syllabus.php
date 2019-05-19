<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
	protected $fillable = ['language', 'description', 'literature'];
	public $timestamps = false;
	 public $table = "syllabuses";


	public function subject()
	{
		return $this->belongsTo('App\Subject');
	}


	




}
