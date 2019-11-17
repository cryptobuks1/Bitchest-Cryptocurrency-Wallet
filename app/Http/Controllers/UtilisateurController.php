<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
	public function __construct(){
		
        $this->middleware('auth');
    }


    public function list(){
    	return view('Clients.index');
    }
}
