<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryToAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->string('category')->nullable();
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
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
