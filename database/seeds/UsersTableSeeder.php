<?php

use App\Map;
use App\Spot;
use App\User;
use App\Sport;
use App\Update;
use App\Feature;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class UsersTableSeeder extends Seeder
{
    protected $output;
    protected $progress;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 50;
        $this->output = new ConsoleOutput();
        $this->progress = new ProgressBar($this->output, $count);
        
        factory(User::class, $count)->create()->each([$this, 'eachUser']);

        $this->progress->finish();
        echo "\n";
    }

    function eachUser($user)
    {
        $isPostmanSpotCreated = Spot::where(['slug' => 'postman'])->exists();
        if (!$isPostmanSpotCreated) {
            factory(Spot::class)->create(['creator_id' => $user->id, 'slug' => 'postman'])->each([$this, 'eachSpot']);
        }
        if (rand(1, 10) < 8) {
            $user->spots()->saveMany(factory(Spot::class, rand(1, 5))->make())->each([$this, 'eachSpot']);
        }
        $user->accounts()->create([
            'account_id' => Str::uuid(),
            'provider' => 'google',
        ]);
        $this->progress->advance();
    }

    function eachSpot($spot)
    {
        $spot->map()->save(factory(Map::class)->make());
        if (rand(1, 10) < 8) {
            $spot->features()->saveMany(factory(Feature::class, rand(1, 5))->make())->each([$this, 'eachFeature']);
        }
        if (rand(1, 10) < 5) {
            $spot->updates()->save(factory(Update::class)->make([
                'creator_id' => User::inRandomOrder()->first()->id
            ]));
        }
        $spot->sports()->attach(array_values(
            Sport::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray()
        ));
    }

    function eachFeature($feature)
    {
        $feature->map()->save(factory(Map::class)->make());
    }
}

