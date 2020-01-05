<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->timestamps();
        });
        Schema::create('sport_spot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('spot_id');
            $table->foreign('spot_id')->references('id')->on('spots');
            $table->unsignedInteger('sport_id');
            $table->foreign('sport_id')->references('id')->on('sports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sports');
        Schema::dropIfExists('sport_spot');
    }
}
