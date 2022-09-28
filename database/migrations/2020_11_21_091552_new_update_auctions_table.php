<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewUpdateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->date('return_date')->after('more_information')->nullable();
            $table->string('return_airline')->after('return_date')->nullable();
            $table->string('return_flight_number')->after('return_airline')->nullable();
            $table->string('return_time')->after('return_flight_number')->nullable();
            $table->string('return_more_information')->after('return_time')->nullable();
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
            $table->dropColumn('return_date');
            $table->dropColumn('return_airline');
            $table->dropColumn('return_flight_number');
            $table->dropColumn('return_time');
            $table->dropColumn('return_more_information');
        });
    }
}
