<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class OrganisationCustomerData extends  Data
{
    public function __construct(
        public string $customer_type = "business" ,
        public string|Optional $ref,
        public string $business_name,
        public string $email,
        public string $description,
        public string $city,
        public string $residential_address,
        public string $state,
        public string $country,
        public string|Optional $registration_certificate,
        public ProofOfAddressData|Optional  $proof_of_address,
    ) {
    }
}
