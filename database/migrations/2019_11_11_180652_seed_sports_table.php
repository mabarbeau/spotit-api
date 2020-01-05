<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class SeedSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sports = array_map( function($sport) { 
            return [
                'name'=> $sport,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]; 
        }, [
            'Skateboard',
            'Longboard',
            'BMX',
            'Motocross',
            'Snowboard',
            'Ski',
            'Tube',
            'Kayak',
            'Rafting',
            'Wakeboard',
            'Surf',
        ]);

        DB::table('sports')->insert($sports);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('sports')->delete();
    }
}
