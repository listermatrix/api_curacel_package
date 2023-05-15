<?php

namespace Jetstream\Curacel;
use Illuminate\Support\ServiceProvider;
use Jetstream\Curacel\API\Interface\IAttachmentService;
use Jetstream\Curacel\API\Interface\IClaimService;
use Jetstream\Curacel\API\Interface\ICreditRequestService;
use Jetstream\Curacel\API\Interface\ICustomerService;
use Jetstream\Curacel\API\Interface\IPolicyService;
use Jetstream\Curacel\API\Interface\IProductService;
use Jetstream\Curacel\API\Interface\IWalletService;
use Jetstream\Curacel\API\Services\AttachmentService;
use Jetstream\Curacel\API\Services\ClaimService;
use Jetstream\Curacel\API\Services\CreditRequestService;
use Jetstream\Curacel\API\Services\CustomerService;
use Jetstream\Curacel\API\Services\PolicyService;
use Jetstream\Curacel\API\Services\ProductService;
use Jetstream\Curacel\API\Services\WalletService;

class CuracelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->mergeConfigFrom(__DIR__.'/config/curacel.php', 'curacel');
        $this->publishes([__DIR__.'/config/curacel.php' => config_path('curacel.php'),]);
    }


    public function  register(): void
    {
        $this->app->singleton(ICustomerService::class, CustomerService::class);
        $this->app->singleton(IProductService::class, ProductService::class);
        $this->app->singleton(IWalletService::class, WalletService::class);
        $this->app->singleton(IPolicyService::class, PolicyService::class);
        $this->app->singleton(IClaimService::class, ClaimService::class);
        $this->app->singleton(IAttachmentService::class, AttachmentService::class);
        $this->app->singleton(ICreditRequestService::class, CreditRequestService::class);
    }
}
