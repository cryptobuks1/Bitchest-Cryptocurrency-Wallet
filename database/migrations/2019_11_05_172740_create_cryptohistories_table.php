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
            $table->bigIncrements('id');
            $table->integer('cryptocurrence_id')->unsigned();
            $table->foreign('cryptocurrence_id')
                ->references('id')
                ->on('cryptocurrencies');
            $table->datetime('date');
            $table->decimal('classes',7,2);
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
