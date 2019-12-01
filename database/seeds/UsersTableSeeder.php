<?php

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
        factory(App\User::class, 50)->create()->each([$this, 'eachUser']);
    }
    
    function eachUser($user)
    {
        if (rand(1, 10) < 8) {
            $user->spots()->saveMany(factory(App\Spot::class, rand(1, 5))->make())->each([$this, 'eachSpot']);
        }
    }

    function eachSpot($spot)
    {
        $spot->map()->save(factory(App\Map::class)->make());
        if (rand(1, 10) < 8) {
            $spot->features()->saveMany(factory(App\Feature::class, rand(1, 5))->make())->each([$this, 'eachFeature']);
        }
    }

    function eachFeature($feature)
    {
        $feature->map()->save(factory(App\Map::class)->make());
    }
}
