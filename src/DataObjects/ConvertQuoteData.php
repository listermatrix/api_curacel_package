<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Attributes\Validation\File;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ConvertQuoteData extends  Data
{
    public function __construct(
        public string $ref,
        public string|Optional $asset_ref,
        public string|Optional $customer_ref,
        public string|Optional $policy_start_date,
        public string|Optional $payment_type,
        public array|Optional  $attachments,
    ) {
    }
}
