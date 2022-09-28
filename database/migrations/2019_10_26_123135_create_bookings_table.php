<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('key')->nullable();
            $table->integer('from')->unsigned();
            $table->integer('to')->unsigned();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('airline')->nullable();
            $table->string('flight_number')->nullable();
            $table->string('passengers')->nullable();
            $table->integer('type')->unsigned();
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
        Schema::dropIfExists('bookings');
    }
}
