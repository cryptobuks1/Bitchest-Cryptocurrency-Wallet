<?php

namespace App\Http\Controllers;

use App\CryptoHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Charts\Facades\Charts;
use App\CryptoCurrency;
use App\User;
use DB;

use App\Wallet;

class GraphController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index(Request $request, $crypto_id)
    {
       $title = ' - Courbe de progression';
       $rates = Cryptohistory::where('crypto_id', '=', $crypto_id)->get();
        $users = User::where('id', Auth::id())->get();
        $crypto = Cryptocurrency::find($crypto_id);
        $wallets = Wallet::where('user_id', Auth::id())->get();
        $rate = [];
        $date = [];

        for ($i=0; $i < 30; $i++) {
            array_push($rate, $rates[$i]->rate);
        }

        // Modification du format de date pour avoir jour-mois-annee

        for ($j=0; $j < 30; $j++) {
            $array_date = explode(' ', $rates[$j]->date);
            $new_format = explode('-',$array_date[0] );
            $reversed = array_reverse($new_format);
            array_push($date, implode('-', $reversed));

        }


        $chart = Charts::create('line', 'highcharts')

                //inversion pour afficher par ordre chronologique

                ->Labels(array_reverse($date))
                ->Values(array_reverse($rate))
                ->Dimensions(700,500)
                ->Responsive(false);

        $total_wallet = 0;

            foreach ($wallets as $wallet) {
                $CryptoCurrency = Cryptocurrency::where('id', $wallet->crypto_id)->first();
                $boughts = DB::table('cryptohistories')
                    ->select(DB::raw(' max(cryptohistories.date) AS date, ANY_VALUE(cryptohistories.rate) AS rate, ANY_VALUE(cryptohistories.crypto_id) AS crypto_id'))
                    ->where('crypto_id', $wallet->crypto_id)
                    ->groupBy('cryptohistories.crypto_id')
                    ->orderBy('cryptohistories.crypto_id')
                    ->get();

                if (!isset($bought_currencies_list[$wallet->crypto_id])) {
                    $bought_currencies_list[$wallet->crypto_id]['CryptoCurrency'] = $CryptoCurrency;
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

        return view('Clients/graph',compact('chart', 'rate', 'title','users','crypto','total_wallet'));
    }
}
