<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('day_time');
            $table->integer('user_id')->nullable();
            $table->string('from');
            $table->string('to');
            $table->text('description');
            $table->integer('passengers');
            $table->string('min_seats');
            // $table->string('more_details');
            $table->string('status')->default('Open');
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
        Schema::dropIfExists('auctions');
    }
}
