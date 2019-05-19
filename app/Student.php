<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $fillable = ['firstname', 'lastname', 'contact', 'indexNumber'];

	public $timestamps = false;


	public function group() 
	{
		return $this->belongsTo('App\Group');
	}


     /**
	* if student belongs to user's group
	* 
	*@param int $studentId
	* 
	*@return bool
	*/
	public static function userStudent($studentId = null): bool
	{
		$student = Student::findOrFail($studentId);
		if(Group::userGroup($student->group_id)) {
			return true;
		} else {
			return false;
		}
	}


}
