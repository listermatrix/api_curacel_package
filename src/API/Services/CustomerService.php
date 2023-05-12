<?php

namespace Jetstream\Curacel\API\Services;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\ICustomerService;
use Jetstream\Curacel\DataObjects\CuracelCustomer;
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
     * @throws RequestException
     */
    public function getAllCustomers()
    {
        return $this->get($this->path);
    }

    /**
     * @throws RequestException
     */
    public function getCustomer($reference)
    {
        return $this->get("{$this->path}/".$reference);
    }

    /**
     * @throws RequestException
     */
    public function createCustomer(IndividualCustomerData $customerData)
    {
        return $this->post($this->path,$customerData->toArray());
    }

    /**
     * @throws RequestException
     */
    public function updateCustomer(IndividualCustomerData $customerData)
    {
        return $this->patch("{$this->path}/{$customerData->ref}",$customerData->toArray());
    }


    /**
     * @throws RequestException
     */
    public function deleteCustomer($reference)
    {
        return $this->delete("{$this->path}/".$reference);
    }
}
