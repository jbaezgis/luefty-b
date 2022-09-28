<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewUpdateToPlaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->integer('country_id')->nullable()->after('id');
            $table->integer('region_id')->nullable()->after('country_id');
            $table->string('image_alt')->nullable()->after('slug');
            $table->text('short_description')->nullable()->after('image_alt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('region_id');
            $table->dropColumn('image_alt');
            $table->dropColumn('short_description');
        });
    }
}
