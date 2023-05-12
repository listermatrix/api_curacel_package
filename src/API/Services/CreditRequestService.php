<?php

namespace Jetstream\Curacel\API\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\ICreditRequestService;
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
     * @return mixed
     * @throws RequestException
     */
    public function requestCredit(CreditRequestData $creditRequest): mixed
    {
        return $this->post($this->path,$creditRequest->toArray());
    }

    /**
     * @param array $params
     * @return mixed
     * @throws RequestException
     */
    public function getCreditRequests(array $params = []): mixed
    {
        return $this->get($this->path,$params);
    }

    /**
     * @param array $params
     * @return mixed
     * @throws RequestException
     */
    public function getExtraAmount(array $params = []): mixed
    {
        return $this->get("$this->path/markup-amount",$params);
    }
}
