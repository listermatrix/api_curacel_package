<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Data;

class PaymentDetailsData extends  Data
{
    public function __construct(
        public string $bank_name,
        public string $account_number,
        public int    $sort_code,
    ) {
    }
}
