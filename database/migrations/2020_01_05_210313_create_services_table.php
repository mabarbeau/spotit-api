<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
        });
        DB::table('services')->insert([
            ['name' => 'google'],
            ['name' => 'facebook'],
        ]);
        Schema::create('service_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('3rd_party_id');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_user');
    }
}
