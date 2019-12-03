<?php

use App\Map;
use App\Spot;
use App\User;
use App\Feature;
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
        $this->progress->advance();
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

