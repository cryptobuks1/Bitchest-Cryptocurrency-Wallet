<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'quantity',
        'user_id',
        'cryptocurrence_id'
    ];


	public function user() 
	{
		return $this->hasMany('App\User');
	}

	public function cryptocurrency() 
	{
		return $this->hasOne('App\Cryptocurrency', 'id');
	}

	public function cryptohistory(){
        return $this->hasOne('App\Transaction');
    }
}
