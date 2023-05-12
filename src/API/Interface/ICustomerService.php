<?php

namespace Jetstream\Curacel\API\Interface;

use Jetstream\Curacel\DataObjects\IndividualCustomerData;

interface ICustomerService
{
    public function createCustomer(IndividualCustomerData $customerData);
    public function updateCustomer(IndividualCustomerData $customerData);
    public function getAllCustomers();
    public function getCustomer($reference);
    public function deleteCustomer($reference);
}
