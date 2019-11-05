<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class SuperAdminController extends Controller
{


/* Affichages de la liste des clients de Bitchest */

public function index(){

    $users = User::paginate(3);
    return view('SuperAdmin.index', compact('users'));
}

/* fonction pour creer un formaulaire d'édition */

public function create(){
	$user = new User();
	return view('SuperAdmin.create',compact('user'));
}

/* fonction pour inserer des informations dans la base de données */

public function store(Request $request){

        $data = request()->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|',
            'status'=>'required|integer'
        ]);

        User::create($data);

         session()->flash('creer','Utilisateur creer avec success');

        return back();
    }

/* Infos utilisateurs de Bitchest */

public function show(User $user){
    return view('SuperAdmin.show', compact('user'));
}

/* fonction pour editer un client */

public function edit(User $user){
        return view('SuperAdmin.edit',compact('user'));
    }

/* fonction pour modifier un utilisateur */

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

/* fonction pour supprimer un client */
    public function destroy(User $user){
        $user->delete();
        session()->flash('supprimer','Utilisateur supprimer avec success');
        return redirect('/SuperAdmin');
    }




}
