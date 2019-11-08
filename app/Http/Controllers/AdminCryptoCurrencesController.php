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
        ->select(DB::raw(' cryptocurrencies.money_name, cryptocurrencies.logo, max(cryptohistories.date), ANY_VALUE(cryptohistories.classes) AS classes'))
        ->join('cryptocurrencies','cryptohistories.cryptocurrence_id', '=', 'cryptocurrencies.id')
        ->groupBy('cryptohistories.cryptocurrence_id')
        ->orderBy('cryptohistories.cryptocurrence_id')
        ->get();

        return view('SuperAdmin.crypto_monnaie', compact('title','cryptocurrency','cryptohistory'));
    
}

}
