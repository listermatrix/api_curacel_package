<?php

namespace Jetstream\Curacel\API;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\ICustomerService;

class CustomerService extends CuracelApiConfig implements ICustomerService
{
    /**
     * @var Repository|Application|\Illuminate\Foundation\Application|mixed
     */
    private mixed $basUrl;
    /**
     * @var Repository|Application|\Illuminate\Foundation\Application|mixed
     */
    private mixed $key;
    /**
     * @var array|string[]
     */
    protected array|\Illuminate\Http\Client\PendingRequest $httpClient;
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
    public function createCustomer($payload)
    {
        return $this->post($this->path,$payload);
    }

    /**
     * @throws RequestException
     */
    public function updateCustomer($payload)
    {
        return $this->patch("{$this->path}/".$payload['ref'],$payload);
    }


    /**
     * @throws RequestException
     */
    public function deleteCustomer($reference)
    {
        return $this->delete("{$this->path}/".$reference);
    }
}
