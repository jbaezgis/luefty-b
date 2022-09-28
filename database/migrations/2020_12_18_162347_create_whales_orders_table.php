<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whales_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('whale_id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('persons');
            $table->string('date');
            $table->string('hotel');
            $table->string('room_number');
            $table->double('total', 6, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whales_orders');
    }
}
