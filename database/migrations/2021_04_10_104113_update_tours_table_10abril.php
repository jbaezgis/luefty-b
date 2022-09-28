<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateToursTable10abril extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->string('duration')->nullable();
            $table->string('type')->nullable();
            $table->integer('departure_location')->nullable();
            $table->time('departure_time')->nullable();
            $table->double('adults_price')->nullable();
            $table->double('children_price')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->dropColumn('type');
            $table->dropColumn('departure_location');
            $table->dropColumn('departure_time');
            $table->dropColumn('adults_price');
            $table->dropColumn('children_price');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
