<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVehicleTypeToServicePrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_prices', function (Blueprint $table) {
            $table->integer('vehicle_type')->after('service_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_prices', function (Blueprint $table) {
            $table->dropColumn('vehicle_type');
        });
    }
}
