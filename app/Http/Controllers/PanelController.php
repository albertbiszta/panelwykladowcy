<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class PanelController extends Controller
{

	public function index()
	{
		$user = User::findOrFail(Auth::id());
		$subjects = $user->subjects()->get();
		return view('panel')->with(compact('subjects'));
	}




}
