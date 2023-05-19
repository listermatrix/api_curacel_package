<?php

namespace Jetstream\Curacel\Package\Interface;

use Jetstream\Curacel\DataObjects\ProductData;

interface IProductService
{
    public function getInsuranceProduct(int $id,array $params = []);

    public function getAllProductTypes();

    public function getAllInsuranceProducts(array $params = []);

    public function purchaseProduct(ProductData $productData);

    public function getAllOrders(array $params = []);

    public function getOrder(int $id);

    public function authorizeOrder(array $payload);

}
