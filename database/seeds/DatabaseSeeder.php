<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(UsersTableSeeder::class);
      $this->call(CyptoCurrencyTableSeeder::class);
      $this->call(WalletTableSeeder::class);
      $this->call(CyptoHistoryTableSeeder::class);
      $this->call(TransactionTableSeeder::class);
        
    }
}
