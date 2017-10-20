<?php

namespace Bwebi\Larabill;

use Bwebi\Larabill\Gateways\IcountGateway;
use Illuminate\Support\Manager;

class GatewayManager extends Manager
{
    /**
     * Get the default gateway driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']['larabill.gateway'];
    }

    /**
     * Set the default gateway driver name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setDefaultDriver($name)
    {
        $this->app['config']['larabill.gateway'] = $name;
    }

    /**
     * Create an instance of the Icount driver.
     *
     * @return IcountGateway
     */
    protected function createIcountDriver()
    {
        $config = $this->app['config']->get('larabill.gateways.icount', []);

        return new IcountGateway();
    }
}
