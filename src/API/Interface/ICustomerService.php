<?php

namespace Jetstream\Curacel\API\Interface;

interface ICustomerService
{
    public function createCustomer($payload);
    public function updateCustomer($payload);
    public function getAllCustomers();
    public function getCustomer($reference);
    public function deleteCustomer($reference);
}
