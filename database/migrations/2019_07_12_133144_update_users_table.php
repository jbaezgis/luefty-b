<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('country', 'country_id');
            $table->integer('location_id')->nullable();
            $table->string('address')->nullable();
            $table->boolean('address_ispublic')->nullable();
            $table->string('web_site')->nullable();
            $table->string('rnc')->nullable();
            $table->boolean('rnc_ispublic')->nullable();
            $table->string('cedula')->nullable();
            $table->boolean('cedula_ispublic')->nullable();
            $table->string('pseudonym')->nullable();
            $table->boolean('public')->nullable();
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
            $table->renameColumn('country_id', 'country');
            $table->dropColumn('location_id');
            $table->dropColumn('address');
            $table->dropColumn('address_ispublic');
            $table->dropColumn('web_site');
            $table->dropColumn('rnc');
            $table->dropColumn('rnc_ispublic');
            $table->dropColumn('cedula');
            $table->dropColumn('cedula_ispublic');
            $table->dropColumn('pseudonym');
            $table->dropColumn('public');
        });
    }
}
