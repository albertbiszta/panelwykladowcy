<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'exam', 'ects'];

    public $timestamps = false;


    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }


    public function grades()
    {
        return $this->hasMany('App\Grade');
    }


    public function groups() 
    {
    	return $this->belongsToMany('App\Group');
    }


    public function lessons()
    {
        return $this->hasMany('App\Lesson')->orderBy('date');
    }


      public function materials()
    {
        return $this->hasMany('App\Material');
    }

    
    public function user() 
    {
    	return $this->belongsTo('App\User');
    }


    public function syllabus()
    {
        return $this->hasOne('App\Syllabus');
    }




    protected function examOptions() 
    {
    	$exam = [0 => 'Nie',
        1 => 'Tak'];
        return $exam;
    }

     /**
    * Auth User subjects list with subject name and id as value
    */
    protected function authSubjects() 
     {
        $authSubjects = User::find(Auth::user()->id)->subjects;
        $subjects = $authSubjects->pluck('name', 'id');

        return $subjects;
    }


    /**
    * if this subject belongs to auth user
    * 
    *@param int $groupId
    * 
    *@return bool
    */
    protected function userSubject($subjectId = null): bool
    {
        $subject = Subject::findOrFail($subjectId);
        if($subject->user_id == Auth::user()->id) {
            return true;
        } else {
            return false;
        }
    }


}
