<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Data;

class ClaimData extends  Data
{
    public function __construct(
        public float $amount,
        public string $currency,
    ) {
    }
}
