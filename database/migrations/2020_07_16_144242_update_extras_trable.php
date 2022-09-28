<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateExtrasTrable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extras', function (Blueprint $table) {
            $table->integer('auction_id')->nullable()->after('id');
            $table->integer('quantity')->nullable()->after('type');
            $table->double('price', 8, 2)->nullable()->after('quantity');
            $table->double('total', 8, 2)->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extras', function (Blueprint $table) {
            $table->dropColumn('auction_id');
            $table->dropColumn('quantity');
            $table->dropColumn('price');
            $table->dropColumn('total');
        });
    }
}
