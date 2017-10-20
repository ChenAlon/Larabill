<?php

namespace Bwebi\Larabill\Contracts;

interface GatewayAuthenticate
{
    public function authenticate() : bool;
}
