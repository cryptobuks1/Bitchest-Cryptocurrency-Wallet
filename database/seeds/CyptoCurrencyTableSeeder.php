<?php

use Illuminate\Database\Seeder;

class CyptoCurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('cryptocurrencies')->insert(array([
            'money_name' => 'Bitcoin',
            'logo' => 'bitcoin.png'
        ],
            [
                'money_name' => 'Ethereum',
                'logo' => 'ethereum.png'
            ],
            [
                'money_name' => 'Ripple',
                'logo' => 'ripple.png'
            ],
            [
                'money_name' => 'Bitcoin Cash',
                'logo' => 'bitcoin-cash.png'
            ],
            [
                'money_name' => 'Cardano',
                'logo' => 'cardano.png'
            ],
            [
                'money_name' => 'Litecoin',
                'logo' => 'litecoin.png'
            ],
            [
                'money_name' => 'NEM',
                'logo' => 'nem.png'
            ],
            [
                'money_name' => 'Stellar',
                'logo' => 'stellar.png'
            ],
            [
                'money_name' => 'IOTA',
                'logo' => 'iota.png'
            ],
            [
                'money_name' => 'DASH',
                'logo' => 'dash.png'
            ]));
    }
}
