<?php

namespace Jetstream\Curacel\API\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\IWalletService;
use Jetstream\Curacel\Models\Customer;

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
    public function getTransactions()
    {
        return $this->get("{$this->path}/transactions");
    }

    /**
     * @throws RequestException
     */
    public function initializeTopUp(array $payload): mixed
    {
        return $this->post("{$this->path}/init-topup",$payload);
    }


}
