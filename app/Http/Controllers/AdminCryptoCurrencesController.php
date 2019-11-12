<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CryptoCurrency;
use App\CryptoHistory;
use DB;


class AdminCryptoCurrencesController extends Controller
{

/* jointure entre les deux tables Cryptocurrences et Cryptohistories */

public function monnaie(){

    $title = 'Cours des crypto monnaies';
    $cryptocurrency = Cryptocurrency::all();

    $cryptohistory = DB::table('cryptohistories')
        ->select(DB::raw(' cryptocurrencies.money_name, cryptocurrencies.logo, max(cryptohistories.date), ANY_VALUE(cryptohistories.rate) AS rate'))
        ->join('cryptocurrencies','cryptohistories.crypto_id', '=', 'cryptocurrencies.id')
        ->groupBy('cryptohistories.crypto_id')
        ->orderBy('cryptohistories.crypto_id')
        ->get();

        return view('SuperAdmin.crypto_monnaie', compact('title','cryptocurrency','cryptohistory'));
    
}

}
