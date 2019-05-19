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


    public static function examOptions() 
    {
    	$exam = [0 => 'Nie',
				1 => 'Tak'];
		return $exam;
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
