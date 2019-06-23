<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'subject_id', 'description', 'fileName'];

	public $timestamps = false;


	public function subject()
	{
		return $this->belongsTo('App\Subject');
	}

	
}
