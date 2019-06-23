<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;


class UserProfileController extends Controller
{
    

    public function publicProfile($lastName, $firstName, $id = null)
    {
    	$user = User::findOrFail($id);;
		$subjects = $user->subjects()->get();
    	return view('profiles.public')->with(compact('subjects', 'user'));
    }

}
