<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptohistory extends Model
{
	 protected $fillable = [
        'date',
        'rate',
        'crypto_id'
    ];
    public function cryptocurrency() 
	{
		return $this->hasOne('App\Cryptocurrency');
	}

	public function cryptohistory(){
        return $this->hasOne('App\Transaction');
    }
}
