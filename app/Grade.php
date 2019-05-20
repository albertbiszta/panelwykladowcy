<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    
    protected $fillable = ['value'];


    public function student()
    {
    	return $this->belongsTo('App\Student');
    }

    public function subject()
    {
    	return $this->belongsTo('App\Subject');
    }

}
