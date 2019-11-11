<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('wallet_id');
            $table->foreign('wallet_id')
                ->references('id')
                ->on('wallets');
            $table->unsignedInteger('cryptohistory_id');
            $table->foreign('cryptohistory_id')
                ->references('id')
                ->on('cryptohistories');
            $table->dateTime('buy_date');
            $table->dateTime('sell_date');
            $table->decimal('quantity', 7, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
