<?php

namespace Bwebi\Larabill\Facades;

use Illuminate\Support\Facades\Facade;

class Larabill extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'larabill';
    }
}