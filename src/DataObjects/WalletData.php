<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Data;

class WalletData extends  Data
{
    public function __construct(
        public float $amount,
        public string $currency,
    ) {
    }
}
