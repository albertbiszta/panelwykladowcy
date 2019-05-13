<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'exam', 'ects'];

    public $timestamps = false;



    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function groups() {
    	return $this->belongsToMany('App\Group');
    }



    public static function examOptions() {
    	$exam = [0 => 'Nie',
				1 => 'Tak'];
		return $exam;
    }


}
