<?php

namespace Jetstream\Curacel\Package\Services;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\Package\Config\CuracelApiConfig;
use Jetstream\Curacel\Package\Interface\IProductService;
use Jetstream\Curacel\DataObjects\ProductData;

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
     * @return array
     */
    public function getAllInsuranceProducts(array $params = []): array
    {
        return $this->get($this->path,$params);
    }

    /**
     * @param int $id
     * @param array $params
     * @return array
     */
    public function getInsuranceProduct(int $id, array $params = []): array
    {
        return $this->get("{$this->path}/".$id,$params);
    }

    /**
     * @return array
     */
    public function getAllProductTypes(): array
    {
        return $this->get('/product-types');
    }

    /**
     * @param ProductData $productData
     * @return array
     */
    public function purchaseProduct(ProductData $productData): array
    {
        return $this->post("{$this->orderPath}",$productData->toArray());
    }

    /**
     * @param array $params
     * @return array
     */
    public function getAllOrders(array $params = []): array
    {
        return $this->get("{$this->orderPath}",$params);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getOrder(int $id): array
    {
        return $this->get("{$this->orderPath}/$id");
    }

    /**
     * @param array $payload
     * @return array
     */
    public function authorizeOrder(array $payload): array
    {
        return $this->post("{$this->orderPath}/authorize",$payload);
    }


}
