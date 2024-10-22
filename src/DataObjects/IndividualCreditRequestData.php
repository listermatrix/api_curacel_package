<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class IndividualCreditRequestData extends  Data
{
    public function __construct(
        public string $ref,
        public string|Optional $narration,
        public IndividualCustomerData  $customer,
        public float $total_amount_paid,
        public float $item_original_price,
    ) {
    }
}
