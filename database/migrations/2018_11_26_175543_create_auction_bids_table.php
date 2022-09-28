<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_bid', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('auction_id')->unsigned();
            $table->foreign('auction_id')->references('id')->on('auctions');

            $table->integer('bid_id')->unsigned();
            $table->foreign('bid_id')->references('id')->on('bids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auction_bid');
    }
}
