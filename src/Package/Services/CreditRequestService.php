<?php

namespace Jetstream\Curacel\Package\Services;

use Jetstream\Curacel\DataObjects\IndividualCreditRequestData;
use Jetstream\Curacel\DataObjects\OrganisationCreditRequestData;
use Jetstream\Curacel\Package\Config\CuracelApiConfig;
use Jetstream\Curacel\Package\Interface\ICreditRequestService;

class CreditRequestService extends CuracelApiConfig implements ICreditRequestService
{

    private string $path;

    public function __construct()
    {
        parent::__construct();
        $this->path = '/insurance-credit-requests';
    }

    /**
     * @param IndividualCreditRequestData|OrganisationCreditRequestData $creditRequest
     * @return array
     */
    public function requestCredit(IndividualCreditRequestData|OrganisationCreditRequestData $creditRequest): array
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
