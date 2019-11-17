<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    // use Providers\SpotProvider;
    // use Providers\UserProvider;

    /**
     * Create application early to use data providers
     */ 
    // public function __construct($name = null, array $data = array(), $dataName = '')
    // {
    //     parent::__construct($name, $data, $dataName);

    //     $this->createApplication();
    // }
}
