<?php

namespace Jetstream\Curacel\Package\Interface;

use Jetstream\Curacel\DataObjects\IndividualCustomerData;
use Jetstream\Curacel\DataObjects\OrganisationCustomerData;

interface ICustomerService
{
    public function createCustomer(IndividualCustomerData|OrganisationCustomerData $customerData);
    public function updateCustomer(IndividualCustomerData|OrganisationCustomerData $customerData);
    public function getAllCustomers();
    public function getCustomer($reference);
    public function deleteCustomer($reference);
}
