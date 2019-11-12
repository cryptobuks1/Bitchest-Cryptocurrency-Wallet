<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCryptohistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptohistories', function (Blueprint $table) {
             $table->increments('id');
            $table->integer('crypto_id')->unsigned();
            $table->foreign('crypto_id')
                ->references('id')
                ->on('crypto_currencies');
            $table->datetime('date');
            $table->decimal('rate',7,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cryptohistories');
    }
}
