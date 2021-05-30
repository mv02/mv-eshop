<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('street', 50)->nullable()->after('email');
            $table->unsignedSmallInteger('house_number')->nullable()->after('street');
            $table->string('town', 50)->nullable()->after('house_number');
            $table->unsignedMediumInteger('postal_code')->nullable()->after('town');
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
            $table->dropColumn(['street', 'house_number', 'town', 'postal_code']);
        });
    }
}
