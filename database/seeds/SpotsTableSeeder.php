<?php

use App\Spot;
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
        $isPostmanSpotCreated = Spot::where(['slug' => 'postman'])->exists();

        factory(Spot::class, $isPostmanSpotCreated ? 50 : 49)->create(['creator_id'=> 1]);

        if (!$isPostmanSpotCreated) factory(Spot::class, 1)->create(['creator_id' => 1, 'slug' => 'postman']);
    }
}
