<?php

use Illuminate\Database\Seeder;

class SpotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {            
        factory(App\Spot::class, 49)->create();
        factory(App\Spot::class, 1)->create(['slug' => 'postman']);
    }
}
