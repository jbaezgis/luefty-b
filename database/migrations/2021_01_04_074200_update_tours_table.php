<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('days');
            $table->integer('location_id')->nullable()->after('id');
            $table->string('image')->nullable()->after('location_id');
            $table->string('title')->nullable()->after('image');
            $table->string('slug')->nullable()->after('title');
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
            $table->dateTime('start_date')->useCurrent();
            $table->dateTime('end_date');
            $table->string('days');
            $table->dropColumn('location_id');
            $table->dropColumn('image');
            $table->dropColumn('title');
            $table->dropColumn('slug');
        });
    }
}
