<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PersonalDataController extends Controller
{
	public function personaldata()
    {

        $users = User::where('id', Auth::id())->get();
        return view('SuperAdmin/personaldata', compact('users')); 
    }
}
