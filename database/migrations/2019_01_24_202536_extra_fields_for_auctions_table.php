<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtraFieldsForAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            // $table->dateTime('day_time')->nullable()->change();
            $table->dropColumn('day_time');
            $table->date('date')->after('id')->nullable();
            $table->time('time')->after('id')->nullable();
            $table->integer('starting_bid')->after('description')->nullable();
            $table->integer('seats')->after('min_seats')->nullable();
            $table->integer('child_seats')->after('min_seats')->nullable();
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
            $table->string('day_time')->nullable();
            $table->dropColumn('date');
            $table->dropColumn('time');
            $table->dropColumn('starting_bid');
            $table->dropColumn('seats');
            $table->dropColumn('child_seats');
        });
    }
}
