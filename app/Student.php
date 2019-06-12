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
	* @param int $studentId
	* 
	* @return bool
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

	 /**
	* Counting student's attendance 
	* 
	* @param int $studentId
	* 
	* @param int $subjectId
	* 
	* @return bool
	*/
	public static function studentAttendances($studentId, $subjectId)
	{
		$student = Student::findOrFail($studentId);

		$attendances = [];
		$attendances['ob'] = 0;
		$attendances['nb'] = 0;
		$attendances['uspr'] = 0;

		$ob = 0;
		foreach($student->attendances as $attendance) {
			if($attendance->lesson->subject_id == $subjectId && $attendance->status == 'Obecny') {
				$attendances['ob'] ++;

			}else if($attendance->lesson->subject_id == $subjectId && $attendance->status == 'Nieobecny') {
				$attendances['nb'] ++;
				} else if($attendance->lesson->subject_id == $subjectId && $attendance->status == 'Nieobecność usprawiedliwiona') {
					$attendances['uspr'] ++;
				}
			}

			return $attendances;

		}


	}
