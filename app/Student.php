<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $fillable = ['firstname', 'lastname', 'contact', 'indexNumber'];

	public $timestamps = false;

	 public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }


	public function group() 
	{
		return $this->belongsTo('App\Group');
	}

	public function grades()
	{
		return $this->hasMany('App\Grade');
	}


     /**
	* if student belongs to user's group
	* 
	*@param int $studentId
	* 
	*@return bool
	*/
	protected function userStudent($studentId = null): bool
	{
		$student = Student::findOrFail($studentId);
		if(Group::userGroup($student->group_id)) {
			return true;
		} else {
			return false;
		}
	}


}
