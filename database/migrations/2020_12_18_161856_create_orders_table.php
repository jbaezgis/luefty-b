<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('whale_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('persons')->nullable();
            $table->string('kids')->nullable();
            $table->string('adult')->nullable();
            $table->string('date')->nullable();
            $table->string('hotel')->nullable();
            $table->string('hotel_location')->nullable();
            $table->string('location')->nullable();
            $table->string('room_number')->nullable();
            $table->double('total', 6, 2)->nullable();
            $table->boolean('paid')->default('0');
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
        Schema::dropIfExists('orders');
    }
}
