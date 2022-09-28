<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChangeToNullableAllAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->string('from')->nullable()->change();
            $table->string('to')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->integer('passengers')->nullable()->change();
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
            $table->string('from')->change();
            $table->string('to')->change();
            $table->text('description')->change();
            $table->integer('passengers')->change();
        });
    }
}
