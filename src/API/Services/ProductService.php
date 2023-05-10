<?php

namespace Jetstream\Curacel\API\Services;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\IProductService;

class ProductService extends CuracelApiConfig implements IProductService
{
    private string $path;
    private string $orderPath;

    public function __construct()
    {
        parent::__construct();
        $this->path = '/products';
        $this->orderPath = '/orders';
    }

    /**
     * @param array $params
     * @throws RequestException
     */
    public function getAllInsuranceProducts(array $params = [])
    {
        return $this->get($this->path,$params);
    }

    /**
     * @param int $id
     * @param array $params
     * @throws RequestException
     */
    public function getInsuranceProduct(int $id, array $params = [])
    {
        return $this->get("{$this->path}/".$id,$params);
    }

    /**
     * @throws RequestException
     */
    public function getAllProductTypes()
    {
        return $this->get('/product-types');
    }

    /**
     * @param array $payload
     * @return mixed
     * @throws RequestException
     */
    public function purchaseProduct(array $payload): mixed
    {
        return $this->post("{$this->orderPath}",$payload);
    }

    /**
     * @param array $params
     * @return mixed
     * @throws RequestException
     */
    public function getAllOrders(array $params = []): mixed
    {
        return $this->get("{$this->orderPath}",$params);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws RequestException
     */
    public function getOrder(int $id): mixed
    {
        return $this->get("{$this->orderPath}/$id");
    }

    /**
     * @param array $payload
     * @return mixed
     * @throws RequestException
     */
    public function authorizeOrder(array $payload): mixed
    {
        return $this->post("{$this->orderPath}/authorize",$payload);
    }


}
