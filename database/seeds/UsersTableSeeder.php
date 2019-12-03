<?php

use App\Map;
use App\Spot;
use App\User;
use App\Feature;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 50)->create()->each([$this, 'eachUser']);
    }
    
    function eachUser($user)
    {
        $isPostmanSpotCreated = Spot::where(['slug' => 'postman'])->exists();
        if (!$isPostmanSpotCreated) {
            factory(Spot::class, 1)->create(['creator_id' => $user->id, 'slug' => 'postman'])->each([$this, 'eachSpot']);
        }
        if (rand(1, 10) < 8) {
            $user->spots()->saveMany(factory(Spot::class, rand(1, 5))->make())->each([$this, 'eachSpot']);
        }
    }

    function eachSpot($spot)
    {
        $spot->map()->save(factory(Map::class)->make());
        if (rand(1, 10) < 8) {
            $spot->features()->saveMany(factory(Feature::class, rand(1, 5))->make())->each([$this, 'eachFeature']);
        }
    }

    function eachFeature($feature)
    {
        $feature->map()->save(factory(Map::class)->make());
    }
}
