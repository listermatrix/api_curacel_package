<?php

namespace Jetstream\Curacel\API\Interface;

interface IProductService
{
    public function getInsuranceProduct($reference);
    public function getAllProductTypes();
    public function getAllInsuranceProducts();

}
