<?php

namespace App\Http\Controllers;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\CryptoCurrency;
use App\Wallet;
use App\User;

class WalletController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function index(){

        /*dans cette fonction je recupere id de l'utilisateur
        * authentifier sur la table user et wallets    
        */

        $users = User::where('id', Auth::id())->get();
        $wallets = Wallet::where('user_id', Auth::id())->get();

        /* récuperation des informations d'un clypto mannaie  */
 
        $currencies_list = [];

        $boughts = array();

        $total_wallet = 0;

        foreach ($wallets as $wallet) {
        	
            $CryptoCurrency = Cryptocurrency::where('id', $wallet->cryptocurrence_id)->first();
            $boughts = DB::table('cryptohistories')
                    ->select(DB::raw(' max(cryptohistories.date) AS date, ANY_VALUE(cryptohistories.classes) AS classes, ANY_VALUE(cryptohistories.cryptocurrence_id) AS cryptocurrence_id'))
                    ->where('cryptocurrence_id', $wallet->cryptocurrence_id)
                    ->groupBy('cryptohistories.cryptocurrence_id')
                    ->orderBy('cryptohistories.cryptocurrence_id')
                    ->get();


            if (!isset($currencies_list[$wallet->cryptocurrence_id])) {
                $currencies_list[$wallet->cryptocurrence_id]['Cryptocurrency'] = $CryptoCurrency;
                $currencies_list[$wallet->cryptocurrence_id]['quantity'] = $wallet->quantity;
                foreach ($boughts as $bought) {

                    $classes = $wallet->quantity*$bought->classes;
                    $currencies_list[$wallet->cryptocurrence_id]['bought'] = $classes;
                }
            }
            else {
                $currencies_list[$wallet->cryptocurrence_id]['quantity'] += $wallet->quantity;

            }
            $total_wallet += $wallet->quantity*$bought->classes;
        };


        return view('AdminUsers/wallet', compact( 'crypto_currency', 'currencies_list', 'users','total_wallet'));
}

}
