<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Attributes\Validation\File;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class QuotationData extends  Data
{
    public function __construct(
        public string $product_code,
        public string $customer_ref,
        public string $payment_type,
        public string $policy_start_date,
        public string|Optional $asset_ref,
        public float  $asset_value,
        public string $pickup_location,
        public string $dropoff_location,
        public array $attachments,
        public float|Optional $broker_premium_rate,
        public float|Optional $broker_taxes,
    ) {
    }
}
