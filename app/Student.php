<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['first_name', 'last_name', 'contact', 'index_number'];

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
     * @return bool
     */
    protected function userStudent($studentId = null): bool
    {
        $student = Student::findOrFail($studentId);
        if (Group::userGroup($student->group_id)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Counting student's attendance
     *
     * @param int $studentId
     * @param int $subjectId
     * @return array
     */
    public static function studentAttendances($studentId, $subjectId): array
    {
        $student = Student::findOrFail($studentId);

        $attendances = [];
        $attendances['ob'] = 0;
        $attendances['nb'] = 0;
        $attendances['uspr'] = 0;

        foreach ($student->attendances as $attendance) {
            if ($attendance->lesson->subject_id == $subjectId && $attendance->status == 'Obecny') {
                $attendances['ob']++;

            } else {
                if ($attendance->lesson->subject_id == $subjectId && $attendance->status == 'Nieobecny') {
                    $attendances['nb']++;
                } else {
                    if ($attendance->lesson->subject_id == $subjectId && $attendance->status == 'Nieobecność usprawiedliwiona') {
                        $attendances['uspr']++;
                    }
                }
            }
        }

        return $attendances;

    }


    /**
     * Counting student's average grade
     *
     * @param int $studentId
     * @param int $subjectId
     * @return float
     */
    public static function averageGrade($studentId, $subjectId): float
    {
        $student = Student::findOrFail($studentId);
        $numberOfGrades = $student->grades->where('subject_id', $subjectId)->count();
        $sum = 0;

        if ($numberOfGrades > 0) {
            foreach ($student->grades->where('subject_id', $subjectId) as $grade) {
                $sum += $grade->value;

            }

            $average = $sum / $numberOfGrades;

            return $average;

        } else {
            return 0.0;
        }


    }

    /**/

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getIndexNumber()
    {
        return $this->index_number;
    }


}
