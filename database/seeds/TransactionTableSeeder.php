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
                                ANY_VALUE(cryptohistories.id) AS cryptohistories_id, 
                                cryptocurrencies.money_name, 
                                cryptocurrencies.logo,
                                max(cryptohistories.date) AS date, 
                                ANY_VALUE(cryptohistories.classes) AS classes'))

            ->join('cryptocurrencies', 'cryptohistories.cryptocurrence_id', '=', 'cryptocurrencies.id')
            ->join('wallets', 'cryptocurrencies.id', '=', 'wallets.id')
            ->groupBy('cryptohistories.cryptocurrence_id')
            ->orderBy('cryptohistories.cryptocurrence_id')
            ->get();

        $date = $this->randDate();
        foreach ($CryptoHistory as $Crypto) {
            DB::Table('Transactions')->insert(array([
                'wallet_id' => $Crypto->wallet_id,
                'cryptohistories_id' => $Crypto->cryptohistories_id,
                'buy_date' => $Crypto->date,
                'sell_date' => $date,
                'quantity' => $Crypto->quantity
            ]));
        }
    }
}
