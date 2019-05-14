<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $fillable = ['firstname', 'lastname', 'contact', 'indexNumber'];

     public $timestamps = false;


     public function group() {
     	return $this->belongsTo('App\Group');
     }
}
