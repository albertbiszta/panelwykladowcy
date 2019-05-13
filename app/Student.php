<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $fillable = ['firstname', 'lastname', 'contact', 'indexNumber'];

     public function group() {
     	return $this->belongsTo('App\Group');
     }
}
