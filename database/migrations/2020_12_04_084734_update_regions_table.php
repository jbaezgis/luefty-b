<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->string('image')->nullable()->after('country_id');
            $table->string('slug')->nullable()->after('name');
            $table->text('description')->nullable()->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('slug');
            $table->dropColumn('description');
        });
    }
}
