<?php

namespace Jetstream\Curacel\API;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\API\Interface\ICustomerService;

class CustomerApi implements ICustomerService
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
    private array|\Illuminate\Http\Client\PendingRequest $httpClient;
    private string $basePath;

    public function __construct()
    {
        $this->basePath = '/customers';
        $this->basUrl = config('curacel.base_url');
        $this->key = config('curacel.api_key');
        $this->httpClient  =  Http::baseUrl($this->basUrl)->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $this->key"
        ]);

    }

    /**
     * @throws RequestException
     */
    public function getAllCustomers()
    {
        return $this->httpClient->get($this->basePath)->throw()->json();
    }

    /**
     * @throws RequestException
     */
    public function getCustomer($reference)
    {
        return $this->httpClient->get("{$this->basePath}/".$reference)->throw()->json();
    }

    /**
     * @throws RequestException
     */
    public function createCustomer($payload)
    {
        return $this->httpClient->post($this->basePath,$payload)->throw()->json();
    }

    /**
     * @throws RequestException
     */
    public function updateCustomer($payload)
    {
        return $this->httpClient->patch("{$this->basePath}/".$payload['ref'],$payload)->throw()->json();
    }


    /**
     * @throws RequestException
     */
    public function deleteCustomer($reference)
    {
        return $this->httpClient->delete("{$this->basePath}/".$reference)->throw()->json();
    }
}
