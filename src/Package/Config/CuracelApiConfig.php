<?php

namespace Jetstream\Curacel\Package\Config;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
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


    protected function get(string $endpoint, array $params = []): array
    {
        $response = $this->httpClient->get($endpoint, $params);
        return $this->getResponseData($response);
    }

    protected function post(string $endpoint, array $payload): array
    {
        $response = $this->httpClient->post($endpoint, $payload);
        return $this->getResponseData($response);
    }

    protected function patch(string $endpoint, array $payload): array
    {
        $response = $this->httpClient->patch($endpoint, $payload);
        return $this->getResponseData($response);
    }

    protected function put(string $endpoint, array $payload): array
    {
        $response = $this->httpClient->put($endpoint, $payload);
        return $this->getResponseData($response);
    }

    protected function delete(string $endpoint, $params = []): array
    {
        $response = $this->httpClient->delete($endpoint, $params);
        return $this->getResponseData($response);
    }

    protected function postFile(string $endpoint, $params = []): array
    {
        $response = $this->httpClient->attach(
            uniqid('cur'),
            $params['file'],
            $params['file']->getClientOriginalName()
        )->post($endpoint);

        return $this->getResponseData($response);
    }

    private function getResponseData($response): array
    {
        $status = ['status' => $response->status()];
        return array_merge($status, $response->json() ?? []);
    }




}
