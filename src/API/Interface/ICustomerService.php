<?php

namespace Jetstream\Curacel\API\Interface;

use Jetstream\Curacel\Models\Customer;

interface ICustomerService
{
    public function createCustomer(Customer $customer);
    public function updateCustomer(Customer $customer);
    public function getAllCustomers();
    public function getCustomer($reference);
    public function deleteCustomer($reference);
}
