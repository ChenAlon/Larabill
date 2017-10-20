<?php

namespace Bwebi\Larabill\Tests;

use Bwebi\Larabill\LarabillFacade;
use Bwebi\Larabill\LarabillServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * Load package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return \Bwebi\Larabill\LarabillServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [LarabillServiceProvider::class];
    }

    /**
     * Load package alias.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Larabill' => LarabillFacade::class,
        ];
    }
}
