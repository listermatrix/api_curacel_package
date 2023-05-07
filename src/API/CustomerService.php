<?php

namespace Jetstream\Curacel\API;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\API\Interface\ICustomerService;

class CustomerService extends CuracelApi implements ICustomerService
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
        return $this->get($this->path)->throw()->json();
    }

    /**
     * @throws RequestException
     */
    public function getCustomer($reference)
    {
        return $this->httpClient->get("{$this->path}/".$reference)->throw()->json();
    }

    /**
     * @throws RequestException
     */
    public function createCustomer($payload)
    {
        return $this->httpClient->post($this->path,$payload)->throw()->json();
    }

    /**
     * @throws RequestException
     */
    public function updateCustomer($payload)
    {
        return $this->httpClient->patch("{$this->path}/".$payload['ref'],$payload)->throw()->json();
    }


    /**
     * @throws RequestException
     */
    public function deleteCustomer($reference)
    {
        return $this->httpClient->delete("{$this->path}/".$reference)->throw()->json();
    }
}
