<?php

namespace Jetstream\Curacel\Package\Services;

use Jetstream\Curacel\DataObjects\OrganisationCustomerData;
use Jetstream\Curacel\Package\Config\CuracelApiConfig;
use Jetstream\Curacel\Package\Interface\ICustomerService;
use Jetstream\Curacel\DataObjects\IndividualCustomerData;

class CustomerService extends CuracelApiConfig implements ICustomerService
{
    private string $path;

    public function __construct()
    {
        parent::__construct();
        $this->path = '/customers';
    }

    /**
     * @return array
     */
    public function getAllCustomers(): array
    {
        return $this->get($this->path);
    }

    /**
     * @param $reference
     * @return array
     */
    public function getCustomer($reference): array
    {
        return $this->get("{$this->path}/".$reference);
    }

    /**
     * @param IndividualCustomerData|OrganisationCustomerData $customerData
     * @return array
     */
    public function createCustomer(IndividualCustomerData|OrganisationCustomerData $customerData): array
    {
        return $this->post($this->path,$customerData->toArray());
    }

    /**
     * @param IndividualCustomerData|OrganisationCustomerData $customerData
     * @return array
     */
    public function updateCustomer(IndividualCustomerData|OrganisationCustomerData $customerData): array
    {
        return $this->patch("{$this->path}/{$customerData->ref}",$customerData->toArray());
    }


    /**
     * @param $reference
     * @return array
     */
    public function deleteCustomer($reference): array
    {
        return $this->delete("{$this->path}/".$reference);
    }
}
