<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;


class UserProfileController extends Controller
{
    

    public function show($fullName, $id = null)
    {
    	$user = User::findOrFail($id);;
		$subjects = $user->subjects()->get();
    	return view('profiles.public', compact('subjects', 'user'));
    }

}
