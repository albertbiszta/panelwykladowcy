<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
     protected $fillable = ['name', 'year', 'contact'];


     public function subjects() {
     	return $this->belongsToMany('App\Subject');
     }

     public function students() {
     	return $this->hasMany('App\Student');
     }

}
