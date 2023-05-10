<?php

namespace Jetstream\Curacel\API\Interface;

interface IProductService
{
    public function getInsuranceProduct(int $id,array $params = []);

    public function getAllProductTypes();

    public function getAllInsuranceProducts(array $params = []);

    public function purchaseProduct(array $payload);

    public function getAllOrders(array $params = []);

    public function getOrder(int $id);

    public function authorizeOrder(array $payload);

}
