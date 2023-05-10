<?php

namespace Jetstream\Curacel\API\Interface;

use Jetstream\Curacel\DataObjects\CuracelCustomer;

interface ICustomerService
{
    public function createCustomer(CuracelCustomer $customer);
    public function updateCustomer(CuracelCustomer $customer);
    public function getAllCustomers();
    public function getCustomer($reference);
    public function deleteCustomer($reference);
}
