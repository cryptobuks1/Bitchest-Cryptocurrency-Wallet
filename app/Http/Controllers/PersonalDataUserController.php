<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PersonalDataUserController extends Controller
{
	public function __construct(){
		
        $this->middleware('auth');
    }

    public function personaldata()
    {

        $users = User::where('id', Auth::id())->get();
        return view('Clients/personaldatauser', compact('users')); 
    }

/* Infos utilisateurs de Bitchest */


    /* fonction pour editer un client */

public function edit($id){

        $user = User::find($id);
        
        return view('AdminUsers.edit',compact('user'));
    }

/* fonction pour modifier un utilisateur */

public function update(Request $request, $id){

        $user =User::find($id);

        $data =request()->validate([

            'name'=>'required',
            'email'=>'required|email|',
        ]);

        $user->update($data);
        return redirect('/wallet');
     
    }

}
