<?php

namespace Jetstream\Curacel;
use Illuminate\Support\ServiceProvider;
use Jetstream\Curacel\API\CustomerService;
use Jetstream\Curacel\API\Interface\ICustomerService;

class CuracelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom('routes/web.php');
        $this->mergeConfigFrom('config/curacel.php', 'curacel');
        $this->publishes(['config/curacel.php' => config_path('curacel.php'),]);
    }


    public function  register(): void
    {
        $this->app->singleton(ICustomerService::class, CustomerService::class);
    }
}
