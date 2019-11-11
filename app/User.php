<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $attributes =[
        'status'=> 0
    ];

   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status'
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     // creation de la fonction get pour gérer les status

   
 public function is_admin(){

        if($this->status == 1){

            return true;
        }
        
        else{

             return false;
        }

    }



    //  public function getstatusAttribute($attributes){

    //     return $this->getstatusOption()[$attributes];
    // }

    // // creation d'un option 

    // public function getstatusOption(){

    //     return [
    //         '0' =>'Inactif',
    //         '1'=>'Actif',
    //         '2' => 'en attent de validation'
    //     ];
    // }

    
    
}
