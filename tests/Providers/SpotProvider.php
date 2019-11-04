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
        return [ "Spot" => [ factory(\App\Spot::class)->create() ] ];
    }
}
