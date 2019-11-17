<?php

namespace Tests\Providers;

trait SpotProvider
{
    /**
     * Provide spot
     *
     * @return array  $test
     **/
    public function SpotProvider()
    {
        $user = factory(\App\User::class)->create();

        return [ "Spot" => [ factory(\App\Spot::class)->create(['creator_id' => $user->id]) ] ];
    }
}
