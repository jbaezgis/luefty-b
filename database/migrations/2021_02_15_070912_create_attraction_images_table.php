<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttractionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attraction_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attraction_id')->nullable();
            $table->string('file_name')->nullable();
            $table->string('type')->nullable();
            $table->integer('size')->nullable();
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
        Schema::dropIfExists('attraction_images');
    }
}
