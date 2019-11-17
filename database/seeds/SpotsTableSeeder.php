<?php

use App\Spot;
use App\User;
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

        if (!$isPostmanSpotCreated) {
            $user = User::firstOrFail();
            
            factory(Spot::class, 1)->create(['creator_id' => $user->id, 'slug' => 'postman']);
        }
    }
}
