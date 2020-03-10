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
        $exam = [
            0 => 'Nie',
            1 => 'Tak',
        ];

        return $exam;
    }


}
