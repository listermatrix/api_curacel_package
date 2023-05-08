<?php

namespace Jetstream\Curacel\API\Config;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class CuracelApiConfig
{
    /**
     * @var Repository|Application|\Illuminate\Foundation\Application|mixed
     */
    protected mixed $baseUrl;
    /**
     * @var Repository|Application|\Illuminate\Foundation\Application|mixed
     */
    protected mixed $apiKey;
    /**
     * @var array|string[]
     */
    protected array|\Illuminate\Http\Client\PendingRequest $httpClient;

    public function __construct()
    {
        $this->baseUrl = config('curacel.base_url');
        $this->apiKey = config('curacel.api_key');
        $this->httpClient = Http::baseUrl($this->baseUrl)->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $this->apiKey"
        ]);
    }


    /**
     * @throws RequestException
     */
    protected function get($endpoint)
    {
        return $this->httpClient->get($endpoint)->throw()->json();
    }

    /**
     * @throws RequestException
     */
    protected function post($endpoint, $payload)
    {
        return $this->httpClient->post($endpoint, $payload)->json();
    }

    /**
     * @throws RequestException
     */
    protected function patch($endpoint, $payload)
    {
        return $this->httpClient->patch($endpoint, $payload)->throw()->json();
    }

    /**
     * @throws RequestException
     */
    protected function delete($endpoint)
    {
        return $this->httpClient->delete($endpoint)->throw()->json();
    }

}