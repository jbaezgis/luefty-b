<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnotherUpdateAuctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->integer('adults')->nullable()->after('passengers');
            $table->integer('infants')->nullable()->after('adults');
            $table->integer('babies')->nullable()->after('infants');
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
            $table->dropColumn('adults');
            $table->dropColumn('infants');
            $table->dropColumn('babies');
        });
    }
}
