<?php

namespace Jetstream\Curacel;
use Illuminate\Support\ServiceProvider;
use Jetstream\Curacel\Package\Interface\IAttachmentService;
use Jetstream\Curacel\Package\Interface\IClaimService;
use Jetstream\Curacel\Package\Interface\ICreditRequestService;
use Jetstream\Curacel\Package\Interface\ICustomerService;
use Jetstream\Curacel\Package\Interface\IPolicyService;
use Jetstream\Curacel\Package\Interface\IProductService;
use Jetstream\Curacel\Package\Interface\IQuotationService;
use Jetstream\Curacel\Package\Interface\IWalletService;
use Jetstream\Curacel\Package\Services\AttachmentService;
use Jetstream\Curacel\Package\Services\ClaimService;
use Jetstream\Curacel\Package\Services\CreditRequestService;
use Jetstream\Curacel\Package\Services\CustomerService;
use Jetstream\Curacel\Package\Services\PolicyService;
use Jetstream\Curacel\Package\Services\ProductService;
use Jetstream\Curacel\Package\Services\QuotationService;
use Jetstream\Curacel\Package\Services\WalletService;

class CuracelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->mergeConfigFrom(__DIR__.'/../config/curacel.php', 'curacel');
        $this->publishes([__DIR__.'/../config/curacel.php' => config_path('curacel.php')]);

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
        $this->app->singleton(IQuotationService::class, QuotationService::class);
    }
}
