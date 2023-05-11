<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Data;

class ClaimData extends  Data
{
    public function __construct(
        public string $policy_number,
        public string $amount,
        public array $attachments,
        public PaymentDetailsData $payment_details
    ) {
    }
}
