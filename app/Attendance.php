<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    
    protected $fillable = ['status', 'subject_id', 'student_id'];
    public $timestamps = false;

    public function student() 
    {
    	return $this->belongsTo('App\Student');
    }

    public function lesson()
    {
    	return $this->belongsTo('App\Lesson');
    }

}
