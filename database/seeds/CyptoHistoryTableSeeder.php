<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CyptoHistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  

    private function randDate(){

        return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
    }


      public function run()
    {
        function getFirstCotation($cryptoname){
            return ord(substr($cryptoname,0,1)) + rand(0, 10);
        }

        function getCotationFor($cryptoname){   
            return ((rand(0, 99)>40) ? 1 : -1) * ((rand(0, 99)>49) ? ord(substr($cryptoname,0,1)) : ord(substr($cryptoname,-1))) * (rand(1,10) * .01);
        }


        $currencies = App\Cryptocurrency::all();
        foreach ($currencies as $currencie) {
            $firstCotation = getFirstCotation($currencie->money_name);

            for ($i=0; $i < 30; $i++) {

                $date = date('Y-m-d', strtotime(-$i.' day'));
               DB::Table('cryptohistories')->insert(array([
                'crypto_id' => $i+1,
                'date' => $date,
                'rate' =>  getFirstCotation($currencie->money_name) + $firstCotation
                ]));
           }
        }
    }
}
