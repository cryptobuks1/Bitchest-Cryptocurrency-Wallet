<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function index(Request $request){

    	if(Auth::attempt([
            
    		'email' => $request->email,
    		'password' => $request->password
    	]))

    	{

    		$user = User::where('email', $request->email)->first();

    		if ($user->is_admin()) {

    			return redirect()->route('SuperAdmin.index');
    		}

                return redirect()->route('index');
    	}

        return back();

    }
}
