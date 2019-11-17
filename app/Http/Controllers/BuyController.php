<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CryptoCurrency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Sidenav;
use App\Transaction;
use App\Wallet;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BuyController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $title = 'Achat de crypto monnaie';
        $cryptocurrency = Cryptocurrency::all();
        $users = User::where('id', Auth::id())->get();
        $wallets = Wallet::where('user_id', Auth::id())->get();

        $total_wallet = 0;
        foreach ($wallets as $wallet) {
            $Cryptocurrency = Cryptocurrency::where('id', $wallet->crypto_id)->first();
            $boughts_totale = DB::table('cryptohistories')
                ->select(DB::raw(' max(cryptohistories.date) AS date, ANY_VALUE(cryptohistories.rate) AS rate, ANY_VALUE(cryptohistories.crypto_id) AS crypto_id'))
                ->where('crypto_id', $wallet->crypto_id)
                ->groupBy('cryptohistories.crypto_id')
                ->orderBy('cryptohistories.crypto_id')
                ->get();

            if (!isset($bought_currencies_list[$wallet->crypto_id])) {
                $bought_currencies_list[$wallet->crypto_id]['Cryptocurrency'] = $Cryptocurrency;
                $bought_currencies_list[$wallet->crypto_id]['quantity'] = $wallet->quantity;
                foreach ($boughts_totale as $bought) {

                    $rate = $wallet->quantity*$bought->rate;
                    $bought_currencies_list[$wallet->crypto_id]['bought'] = $rate;
                }
            }
            else {
                $bought_currencies_list[$wallet->crypto_id]['quantity'] += $wallet->quantity;

            }
            
            $total_wallet += ($wallet->quantity*$bought->rate);
        };

        

        return view('AdminUsers/buy', compact('title','cryptocurrency','users','total_wallet'));
    }



    public function update(Request $request)
    {


        $rules = [
            'quantity' => 'required',
            'selectbasic' => 'required'
        ];

        $input = $request->only(
            'quantity',
            'selectbasic'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails()) {
           return Redirect::to('buy')
                ->withErrors($validator);
        }

        $users = User::where('id', Auth::id())->get();
        foreach ($users as $user) {

            $money_name_id = DB::table('wallets')
                ->select(DB::raw(' wallets.id AS wallet_id, wallets.user_id, wallets.crypto_id'))
                ->where('wallets.user_id', $user->id)
                ->get();
        }

        $money = DB::table('cryptocurrencies')
                    ->select(DB::raw(' cryptocurrencies.id, cryptocurrencies.money_name, cryptocurrencies.logo'))
                    ->where('cryptocurrencies.id', $input['selectbasic'])
                    ->get();

        foreach ($money as $moneys) {

           $money_name = $moneys->money_name;
           $cryptohistories = $moneys->id;
        }

        foreach ($money_name_id as $money_name_ids) {
            $wallet = $money_name_ids->wallet_id;
            //dd($wallet);
        }

        $cryptohistory = DB::table('cryptohistories')
                ->select(DB::raw(' ANY_VALUE(cryptohistories.id) AS crypto_history_id,max(cryptohistories.date) AS date, ANY_VALUE(cryptohistories.rate) AS rate, ANY_VALUE(cryptohistories.crypto_id) AS crypto_id'))
                ->where('crypto_id', $cryptohistories)
                ->groupBy('cryptohistories.crypto_id')
                ->orderBy('cryptohistories.crypto_id')
                ->get();
        foreach ($cryptohistory as  $crypto_historys) {
            $crypto_his_id = $crypto_historys->crypto_history_id;
            $buy_date_trans = $crypto_historys->date;
            $crypto_id_trans = $crypto_historys->crypto_id;
        }

        function getFirstCotation($cryptoname){
            return ord(substr($cryptoname,0,1)) + rand(0, 10);
        }

        function getCotationFor($cryptoname){   
            return ((rand(0, 99)>40) ? 1 : -1) * ((rand(0, 99)>49) ? ord(substr($cryptoname,0,1)) : ord(substr($cryptoname,-1))) * (rand(1,10) * .01);
        }

        $sell_date_tras = new Carbon();

        $quantity = $input['quantity'];
      
        // $wallet_id =  $wallet;
        
        $cryptohistory_id = $crypto_his_id;
        $buy_date = $buy_date_trans;
        $sell_date = $sell_date_tras;

        $getFirstCotation = getFirstCotation($moneys->money_name);

        $crypto_id = DB::table('wallets')->insertGetId(
            ['crypto_id' => $cryptohistories, 'user_id' => $user->id, 'quantity' => $quantity]
        );

        $crypto_histories_trans = DB::table('cryptohistories')->insertGetId(
            ['crypto_id' => $crypto_id_trans, 'date' => $sell_date_tras, 'rate' => $getFirstCotation]
        );

        $get_crypto_ids = DB::table('wallets')
                    ->select(DB::raw('Max(id) AS wallets'))
                    ->get();

        foreach ($get_crypto_ids as $get_crypto_id) {
            
            $trans_crypto_id = $get_crypto_id->wallets;
            $transactions = DB::table('transactions')->insertGetId(
                    ['quantity' => $quantity,'quantity' => $quantity, 'wallet_id' => $trans_crypto_id, 'crypto_history_id' => $cryptohistory_id, 'buy_date' => $buy_date, 'sell_date' => $sell_date]
                );
        }

        Session::flash('flash_message', 'Votre achat est validé!');

        return redirect('wallet');
    }

}
