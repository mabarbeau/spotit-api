<?php

namespace Tests\Providers;

trait UserProvider
{
    /**
     * Provide spot
     *
     * @return array  $test
     **/
    public function UserProvider()
    {
        return [ "User" => [ factory(\App\User::class)->create() ] ];
    }
}
