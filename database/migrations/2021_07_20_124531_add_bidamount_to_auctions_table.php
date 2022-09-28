<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBidamountToAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->integer('updated_by')->nullable();
            $table->double('bid_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->dropColumn('updated_by');
            $table->dropColumn('bid_amount');
        });
    }
}
