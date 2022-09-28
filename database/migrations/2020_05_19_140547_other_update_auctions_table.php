<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OtherUpdateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->integer('service_id')->after('auction_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('nationality')->nullable();
            $table->string('language')->nullable();
            // $table->integer('baby_seats')->nullable();
            // $table->integer('child_seats')->nullable();
            $table->string('type')->nullable();
            $table->time('arrival_time')->nullable();
            $table->integer('want_to_arrive')->nullable();
            $table->time('pickup_time')->nullable();
            $table->string('arrival_airline')->nullable();
            $table->string('flight_number')->nullable();
            $table->text('more_information')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->integer('service_price_id')->nullable();
            $table->double('order_total')->nullable();
            $table->double('catering')->nullable();
            $table->double('fare')->nullable();
            $table->double('extra_payment')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->double('discount')->nullable();
            $table->double('paid_amount')->nullable();
            $table->dateTime('paid_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
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
            $table->dropColumn('service_id');
            $table->dropColumn('full_name');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('nationality');
            $table->dropColumn('language');
            // $table->dropColumn('baby_seats');
            // $table->dropColumn('child_seats');
            $table->dropColumn('type');
            $table->dropColumn('arrival_time');
            $table->dropColumn('want_to_arrive');
            $table->dropColumn('pickup_time');
            $table->dropColumn('arrival_airline');
            $table->dropColumn('flight_number');
            $table->dropColumn('more_information');
            $table->dropColumn('ip');
            $table->dropColumn('service_price_id');
            $table->dropColumn('order_total');
            $table->dropColumn('catering');
            $table->dropColumn('fare');
            $table->dropColumn('extra_payment');
            $table->dropColumn('coupon_id');
            $table->dropColumn('discount');
            $table->dropColumn('paid_amount');
            $table->dateTime('paid_date');
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_status');
        });
    }
}
