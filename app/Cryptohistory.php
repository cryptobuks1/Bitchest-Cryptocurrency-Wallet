<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptohistory extends Model
{

    public function cryptocurrency() 
	{
		return $this->hasMany('App\CryptoCurrency');
	}
}
