<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class SuperAdminController extends Controller
{

 public function __construct(){
        $this->middleware('auth');
    }

/* Affichages de la liste des clients de Bitchest */

public function index(){

    $users = User::paginate(3);
   

    return view('Admin.index', compact('users'));
}

/* fonction pour creer un formaulaire d'édition */

public function create(){
	$user = new User();
	return view('Admin.create',compact('user'));
}

/* fonction pour inserer des informations dans la base de données */

public function store(Request $request){

      $this->validate($request, [
        'name'=>'required',
        'email'=>'required|email|',
        'password'=>'required',
        'status'=>'required|integer'
        ]);

       $users = new User;

       $users->name = $request->input('name');
       $users->email = $request->input('email');
       $users->password = Hash::make($request->input('password'));
       $users->status = $request->input('status');

       session()->flash('creer','Utilisateur creer avec success');

       $users->save();

        return back();
    }

/* Infos utilisateurs de Bitchest */

public function show($id){

    $user =User::find($id);

    return view('Admin.show',compact('user'));
}

/* fonction pour editer un client */

public function edit($id){

        $user = User::find($id);
        
        return view('Admin.edit',compact('user'));
    }

/* fonction pour modifier un utilisateur */

public function update(Request $request, $id){

        $user =User::find($id);

        $data =request()->validate([

            'name'=>'required',
            'email'=>'required|email|',
            'status'=>'required|integer',
        ]);

        $user->update($data);
        session()->flash('modifier','Utilisateur modifier avec success');
        return redirect('Admin/' .$user->id);
     
    }

/* fonction pour supprimer un client */

    public function destroy($id){
        $user =User::find($id);
        $user->delete();
        session()->flash('supprimer','Utilisateur supprimer avec success');
        return redirect('/Admin');
    }

}
