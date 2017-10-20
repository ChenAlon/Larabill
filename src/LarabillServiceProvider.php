<?php

namespace Bwebi\Larabill;

use Illuminate\Support\ServiceProvider;

class LarabillServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/larabill.php' => config_path('larabill.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerGatewayManager();
        $this->registerGatewayDriver();

        $this->app->alias(Larabill::class, 'Larabill');

        $this->mergeConfigFrom(
            __DIR__.'/config/larabill.php', 'larabill'
        );
    }

    /**
     * Register the gateway manager instance.
     *
     * @return void
     */
    protected function registerGatewayManager()
    {
        $this->app->singleton('larabill', function ($app) {
            return new GatewayManager($app);
        });
    }

    /**
     * Register the gateway driver instance.
     *
     * @return void
     */
    protected function registerGatewayDriver()
    {
        $this->app->singleton('larabill.store', function ($app) {
            // First, we will create the gateway manager which is responsible for the
            // creation of the various gateway drivers when they are needed by the
            // application instance, and will resolve them on a lazy load basis.
            return $app->make('larabill')->driver();
        });
    }
}
