<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptocurrency extends Model
{
    protected $fillable = [
        'money_name', 'logo'
    ];

    public function cryptohistorys(){
        return $this->belongsTo('App\Cryptohistory');
    }
}
