<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('updates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->integer('updatable_id');
            $table->string('updatable_type');
            $table->string('status', 8)->default('pending');
            $table->json('data');
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
        Schema::dropIfExists('updates');
    }
}
