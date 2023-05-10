<?php

namespace Jetstream\Curacel\API\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\IWalletService;
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
     * @throws RequestException
     */
    public function getBalance()
    {
        return $this->get("{$this->path}/balance");
    }

    /**
     * @throws RequestException
     */
    public function getTransactions(array $params = []): mixed
    {
        return $this->get("{$this->path}/transactions",$params);
    }

    /**
     * @throws RequestException
     */
    public function initializeTopUp(WalletData $walletData): mixed
    {
        return $this->post("{$this->path}/init-topup",$walletData->toArray());
    }


}
