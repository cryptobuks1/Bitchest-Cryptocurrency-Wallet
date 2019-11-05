<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
/*
|--------------------------------------------------------------------------
| Affichages de la liste des clients de Bitchest
|--------------------------------------------------------------------------
*/

public function index(){

    $users = User::paginate(5);
    return view('SuperAdmin.index', compact('users'));
}

/*
|--------------------------------------------------------------------------
| Infos utilisateurs de Bitchest
|--------------------------------------------------------------------------
*/

public function show(User $user){
	return view('SuperAdmin.show', compact('user'));
}

public function create(){
	$user = new User();
	return view('SuperAdmin.create',compact('user'));
}




public function store(){

        $data =request()->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|',
            'status'=>'required|integer'
        ]);

        User::create($data);

        return back();
    }

public function edit(User $user){
        return view('SuperAdmin.edit',compact('user'));
    }


public function update(User $user){

        $data =request()->validate([

            'name'=>'required',
            'email'=>'required|email|',
            'status'=>'required|integer',
        ]);

        $user->update($data);
        session()->flash('modifier','Utilisateur modifier avec success');
        return redirect('SuperAdmin/' .$user->id);
     
    }


    public function destroy(User $user){
        $user->delete();
        session()->flash('supprimer','Utilisateur supprimer avec success');
        return redirect('/SuperAdmin');
    }




}
