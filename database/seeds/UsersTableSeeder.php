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
        factory(App\User::class, 50)->create()->each(function ($user) {
            if (rand(1, 10) < 8) {
                $user->spots()->saveMany(factory(App\Spot::class, rand(1, 5))->make());
            }
        });
    }
}
