<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptohistory extends Model
{

    public function cryptocurrency() 
	{
		return $this->hasOne('App\Cryptocurrency');
	}

	public function cryptohistory(){
        return $this->hasOne('App\Transaction');
    }
}
