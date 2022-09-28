<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_types', function (Blueprint $table) {
            $table->string('type')->after('id')->nullable();
            $table->string('max_passengers')->after('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_types', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('max_passengers');
        });
    }
}
