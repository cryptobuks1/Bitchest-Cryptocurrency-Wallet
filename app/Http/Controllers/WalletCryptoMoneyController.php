<?php

namespace App\Http\Controllers;

use App\CryptoCurrency;
use App\CryptoHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Transaction;
use App\Wallet;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Session;

class WalletCryptoMoneyController extends Controller
{
    

    public function __construct()
    {
        
        $this->middleware('auth');
    }

    public function index(Request $request, $crypto_id){

        $crypto = Cryptocurrency::find($crypto_id);
        $title = $crypto->money_name;
        // on récupère l'id du wallet de l'utilisateur en cours
        $wallets = Wallet::where('user_id', Auth::id())
            ->where('crypto_id', $crypto_id)
            ->get();
        $wallet_totals = Wallet::where('user_id', Auth::id())->get();
        $users = User::where('id', Auth::id())->get();

        $total_wallet = 0;
        foreach ($wallet_totals as $wallet_total) {
            $CryptoCurrency = Cryptocurrency::where('id', $wallet_total->crypto_id)->first();
            $boughts_totale = DB::table('cryptohistories')
                ->select(DB::raw(' max(cryptohistories.date) AS date, ANY_VALUE(cryptohistories.rate) AS rate, ANY_VALUE(cryptohistories.crypto_id) AS crypto_id'))
                ->where('crypto_id', $wallet_total->crypto_id)
                ->groupBy('cryptohistories.crypto_id')
                ->orderBy('cryptohistories.crypto_id')
                ->get();

            if (!isset($bought_currencies_list[$wallet_total->crypto_id])) {
                $bought_currencies_list[$wallet_total->crypto_id]['CryptoCurrency'] = $CryptoCurrency;
                $bought_currencies_list[$wallet_total->crypto_id]['quantity'] = $wallet_total->quantity;
                foreach ($boughts_totale as $bought) {

                    $rate = $wallet_total->quantity*$bought->rate;
                    $bought_currencies_list[$wallet_total->crypto_id]['bought'] = $rate;
                }
            }
            else {
                $bought_currencies_list[$wallet_total->crypto_id]['quantity'] += $wallet_total->quantity;

            }
            $total_wallet += $wallet_total->quantity*$bought->rate;
        }

        //Récupération des transaction d'une crypto particulière de l'utilisateur en cours

        $transactions = array();

        foreach ($wallets as $wallet) {
            $transactions = Transaction::where('wallet_id', $wallet->id)->get(); 

            $boughts = DB::table('cryptohistories')
                    ->select(DB::raw(' max(transactions.buy_date) AS date_transaction,max(cryptohistories.date) AS date, ANY_VALUE(cryptohistories.rate) AS rate, ANY_VALUE(transactions.wallet_id) AS wallet_id,ANY_VALUE(transactions.quantity) AS quantity, ANY_VALUE(transactions.crypto_history_id) AS crypto_history_id'))
                    ->join('transactions', 'cryptohistories.id', '=', 'transactions.crypto_history_id')
                    ->where('transactions.wallet_id', $wallet->id)
                    ->groupBy('cryptohistories.crypto_id')
                    ->orderBy('cryptohistories.crypto_id')
                    ->get();

        }

        // $rate = Cours le plus récent

        foreach ($boughts as $bought) {



            $rate = $bought->rate;

            $boughts_rate = DB::table('transactions')

                ->join('cryptohistories', 'transactions.buy_date', '=', 'cryptohistories.date')
                ->join('cryptocurrencies', 'cryptocurrencies.id', '=', 'cryptohistories.crypto_id')
                ->where('transactions.buy_date', $bought->date_transaction)
                ->get();
        }

        //prix en euros lors de l'achat
        $buy_euro = $boughts_rate[0]->quantity * $boughts_rate[0]->rate;

    
        //prix en euros maintenant
        $sell_euro = $boughts_rate[0]->quantity * $rate;

        //plus-value
        $capital_gain = $sell_euro - $buy_euro;


        //calcul du total de cryptos
        $total = 0;
        foreach($transactions as $transaction) {
            $total += $transaction->quantity;
        }


        return view('Clients/wallet_cryptomoney', compact('title', 'transactions', 'total', 'users', 'rate', 'capital_gain', 'crypto','total_wallet'));
    }

    // fonction pour gérer la vente de crypto monnaie 

    public function destroy($id){

        $destroy = Wallet::find($id);

        $shoproduct = Transaction::find($id)->wallet;
        $rate = Cryptohistory::find($id)->rate;

        $total = 0 ;
        $quantity = $shoproduct->quantity;
        $rate  =  $rate;
        $total += $quantity * $rate;

        Session::put('total',$total);
      
        $destroy->delete();

        Session::flash('flash_message','Votre crypto monnaie à éte vendu avec succées');
        return redirect('/wallet')->with('success','total');
    }

}
