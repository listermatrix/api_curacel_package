<?php

namespace Jetstream\Curacel;
use Illuminate\Support\ServiceProvider;
use Jetstream\Curacel\API\CustomerApi;
use Jetstream\Curacel\API\Interface\ICustomerService;

class CuracelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->mergeConfigFrom(
            __DIR__.'/config/curacel.php', 'curacel'
        );
        $this->publishes([
            __DIR__.'/config/curacel.php' => config_path('curacel.php'),
        ]);
    }


    public function  register(): void
    {
        $this->app->bind(ICustomerService::class, CustomerApi::class);
    }
}
