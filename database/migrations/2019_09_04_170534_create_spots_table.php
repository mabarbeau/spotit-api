<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpotsTable extends Migration
{
    /**
     * Create spots table
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 50)->unique();
            $table->string('title', 100);
            $table->longText('description');
            $table->longText('address');
            $table->string('locality', 50)->nullable();
            $table->string('region', 50)->nullable();
            $table->string('postcode', 20);
            $table->string('country', 2);
            $table->timestamps();
        });
    }
    /**
     * Delete spots table
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('spots');
    }
}
