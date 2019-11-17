<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cryptocurrency;
use App\Cryptohistory;
use App\Wallet;
use App\User;
use DB;

class SellController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    } 

    public function index(){

       
        $crypto_currency = Cryptocurrency::all();
        $users = User::where('id', Auth::id())->get();
        $wallets = Wallet::where('user_id', Auth::id())->get();

        $bought_currencies_list = [];
        $total_wallet = 0;
            foreach ($wallets as $wallet) {
                $CryptoCurrencies = Cryptocurrency::where('id', $wallet->crypto_id)->first();
                $boughts = DB::table('cryptohistories')
                    ->select(DB::raw(' max(cryptohistories.date) AS date, ANY_VALUE(cryptohistories.rate) AS rate, ANY_VALUE(cryptohistories.crypto_id) AS crypto_id'))
                    ->where('crypto_id', $wallet->crypto_id)
                    ->groupBy('cryptohistories.crypto_id')
                    ->orderBy('cryptohistories.crypto_id')
                    ->get();

                if (!isset($bought_currencies_list[$wallet->crypto_id])) {
                    $bought_currencies_list[$wallet->crypto_id]['Cryptocurrency'] = $CryptoCurrencies;
                    $bought_currencies_list[$wallet->crypto_id]['quantity'] = $wallet->quantity;
                    foreach ($boughts as $bought) {
                        $rate = $wallet->quantity*$bought->rate;
                        $bought_currencies_list[$wallet->crypto_id]['bought'] = $rate;
                    }
                }
                else {
                    $bought_currencies_list[$wallet->crypto_id]['quantity'] += $wallet->quantity;

                }
                $total_wallet += $wallet->quantity*$bought->rate;
            };

        return view('AdminUsers/sell', compact('crypto_currency','users','total_wallet','bought_currencies_list'));
    }
}
