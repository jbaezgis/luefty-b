<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountrycodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countrycodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iso')->nullable();
            $table->string('name')->nullable();
            $table->string('nicename')->nullable();
            $table->string('iso3')->nullable();
            $table->string('numcode')->nullable();
            $table->string('phonecode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countrycodes');
    }
}
