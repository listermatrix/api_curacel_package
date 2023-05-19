<?php

namespace Jetstream\Curacel\Package\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\Package\Config\CuracelApiConfig;
use Jetstream\Curacel\Package\Interface\ICreditRequestService;
use Jetstream\Curacel\DataObjects\CreditRequestData;
use Jetstream\Curacel\DataObjects\WalletData;

class CreditRequestService extends CuracelApiConfig implements ICreditRequestService
{

    private string $path;

    public function __construct()
    {
        parent::__construct();
        $this->path = '/insurance-credit-requests';
    }

    /**
     * @param CreditRequestData $creditRequest
     * @return array
     */
    public function requestCredit(CreditRequestData $creditRequest): array
    {
        return $this->post($this->path,$creditRequest->toArray());
    }

    /**
     * @param array $params
     * @return array
     */
    public function getCreditRequests(array $params = []): array
    {
        return $this->get($this->path,$params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function getExtraAmount(array $params = []): array
    {
        return $this->get("$this->path/markup-amount",$params);
    }
}
