<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneIspublicToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('phone_ispublic')->default(1)->after('phone');
            $table->boolean('address_ispublic')->default(1)->change();
            $table->boolean('cedula_ispublic')->default(1)->change();
            $table->boolean('rnc_ispublic')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('phone_ispublic')->default(1)->after('phone');
            $table->boolean('address_ispublic')->change();
            $table->boolean('cedula_ispublic')->change();
            $table->boolean('rnc_ispublic')->change();
        });
    }
}
