<?php

namespace App\Http\Controllers;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Cryptocurrency;
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
 
        // récupére les infos de la crypto via la clé (nom, logo etc)
        $bought_currencies_list = [];
        $boughts = array();
        $total_wallet = 0;
        foreach ($wallets as $wallet) {
            $CryptoCurrency = CryptoCurrency::where('id', $wallet->crypto_id)->first();
            $boughts = DB::table('cryptohistories')
                    ->select(DB::raw(' max(cryptohistories.date) AS date, ANY_VALUE(cryptohistories.rate) AS rate, ANY_VALUE(cryptohistories.crypto_id) AS crypto_id'))
                    ->where('crypto_id', $wallet->crypto_id)
                    ->groupBy('cryptohistories.crypto_id')
                    ->orderBy('cryptohistories.crypto_id')
                    ->get();


            if (!isset($bought_currencies_list[$wallet->crypto_id])) {
                $bought_currencies_list[$wallet->crypto_id]['Cryptocurrency'] = $CryptoCurrency;
                $bought_currencies_list[$wallet->crypto_id]['quantity'] = $wallet->quantity;
                foreach ($boughts as $bought) {

                    $rate = $wallet->quantity*$bought->rate;
                    $bought_currencies_list[$wallet->crypto_id]['bought'] = $rate;
                }
            }
            else {
                $bought_currencies_list[$wallet->crypto_id]['quantity'] += $wallet->quantity;

            }

            $total_wallet += ($wallet->quantity*$bought->rate);

        }


        return view('Clients/wallet', compact( 'title', 'crypto_currency', 'bought_currencies_list', 'users','total_wallet'));
}

}
