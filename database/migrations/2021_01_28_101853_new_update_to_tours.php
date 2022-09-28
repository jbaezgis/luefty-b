<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewUpdateToTours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->integer('attraction_id')->nullable()->after('location_id');
            $table->string('image_alt')->nullable()->after('image');
            $table->text('short_description')->nullable()->after('location');
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
            $table->dropColumn('attraction_id');
            $table->dropColumn('image_alt');
            $table->dropColumn('short_description');
        });
    }
}
