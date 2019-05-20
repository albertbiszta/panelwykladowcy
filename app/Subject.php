<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'exam', 'ects'];

    public $timestamps = false;



    public function groups() 
    {
    	return $this->belongsToMany('App\Group');
    }

    
    public function user() 
    {
    	return $this->belongsTo('App\User');
    }

    public function syllabus()
    {
        return $this->hasOne('App\Syllabus');
    }

    public function grades()
    {
        return $this->hasMany('App\Grade');
    }


    public static function examOptions() 
    {
    	$exam = [0 => 'Nie',
				1 => 'Tak'];
		return $exam;
    }

     /**
    * Auth User subjects list with subject name and id as value
    */
    public static function authSubjects() 
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
    public static function userSubject($subjectId = null): bool
    {
        $subject = Subject::findOrFail($subjectId);
        if($subject->user_id == Auth::user()->id) {
            return true;
        } else {
            return false;
        }
    }


}
