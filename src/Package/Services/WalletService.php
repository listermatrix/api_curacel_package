<?php

namespace Jetstream\Curacel\Package\Services;

use Jetstream\Curacel\Package\Config\CuracelApiConfig;
use Jetstream\Curacel\Package\Interface\IWalletService;
use Jetstream\Curacel\DataObjects\WalletData;

class WalletService extends CuracelApiConfig implements IWalletService
{

    private string $path;

    public function __construct()
    {
        parent::__construct();
        $this->path = '/partners/wallet';
    }

    /**
     * @return array
     */
    public function getBalance(): array
    {
        return $this->get("{$this->path}/balance");
    }

    /**
     */
    public function getTransactions(array $params = []): array
    {
        return $this->get("{$this->path}/transactions",$params);
    }

    /**
     */
    public function initializeTopUp(WalletData $walletData): array
    {
        return $this->post("{$this->path}/init-topup",$walletData->toArray());
    }


}
