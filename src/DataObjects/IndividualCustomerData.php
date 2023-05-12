<?php

namespace Jetstream\Curacel\DataObjects;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class IndividualCustomerData extends  Data
{
    public function __construct(
        public string $ref,
        public string $first_name,
        public string $last_name,
        public string|Optional $middle_name,
        public string|Optional $sex,
        public string $birth_date,
        public string|Optional $email,
        public string|Optional $bvn,
        public string|Optional $occupation,
        public string|Optional $city,
        public string|Optional $residential_address,
        public string|Optional $state,
        public string|Optional $country,
        public string|Optional $next_of_kin_name,
        public string|Optional $next_of_kin_phone,
        public ProofOfAddressData|Optional  $proof_of_address,
    ) {
    }
}
