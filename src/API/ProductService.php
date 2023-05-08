<?php

namespace Jetstream\Curacel\API;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\IProductService;

class ProductService extends CuracelApiConfig implements IProductService
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
        $this->path = '/products';
    }

    /**
     * @throws RequestException
     */
    public function getAllInsuranceProducts()
    {
        return $this->get($this->path)->throw()->json();
    }

    /**
     * @throws RequestException
     */
    public function getInsuranceProduct($reference)
    {
        return $this->get("{$this->path}/".$reference)->throw()->json();
    }

    /**
     * @throws RequestException
     */
    public function getAllProductTypes()
    {
        return $this->get('/product-types')->throw()->json();
    }

}
