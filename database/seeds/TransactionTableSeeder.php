<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function randDate()
    {
        return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
    }

     public function run()
    {
        $CryptoHistory = DB::table('cryptohistories')
            ->select(DB::raw(' wallets.id AS wallet_id, 
                                wallets.quantity AS quantity,
                                ANY_VALUE(cryptohistories.id) AS crypto_history_id, 
                                cryptocurrencies.money_name, 
                                cryptocurrencies.logo,
                                max(cryptohistories.date) AS date, 
                                ANY_VALUE(cryptohistories.rate) AS rate'))
            ->join('cryptocurrencies', 'cryptohistories.crypto_id', '=', 'cryptocurrencies.id')

            ->join('wallets', 'cryptocurrencies.id', '=', 'wallets.id')
            
            ->groupBy('cryptohistories.crypto_id')
            ->orderBy('cryptohistories.crypto_id')
            ->get();

        $date = $this->randDate();
        foreach ($CryptoHistory as $Crypto) {
            DB::Table('Transactions')->insert(array([
                'wallet_id' => $Crypto->wallet_id,
                'crypto_history_id' => $Crypto->crypto_history_id,
                'buy_date' => $Crypto->date,
                'sell_date' => $date,
                'quantity' => $Crypto->quantity
            ]));
        }
    }
}
