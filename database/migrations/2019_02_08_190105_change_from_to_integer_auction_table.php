<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFromToIntegerAuctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->integer('from_location')->nullable()->after('from');
            $table->integer('to_location')->nullable()->after('to');
            $table->string('title')->nullable()->after('user_id');
            $table->integer('pickup_from_location')->nullable()->after('title');
            $table->integer('open_tickets')->nullable()->after('from_location');
            $table->integer('vehicle_type')->nullable()->after('baby_seats');
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
            $table->dropColumn('from_location');
            $table->dropColumn('to_location');
            $table->dropColumn('title');
            $table->dropColumn('pickup_from_location');
            $table->dropColumn('open_tickets');
            $table->dropColumn('vehicle_type');
        });
    }
}
