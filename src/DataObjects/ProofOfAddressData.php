<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ProofOfAddressData extends  Data
{
    public function __construct(
        public string|Optional $type,
        public string|Optional $url,
    ) {
    }
}
