<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Data;

class VoucherData extends  Data
{

    public function __construct(
        public int $claim_id,
        public int $discharge_voucher_id,
        public string $status,
        public string $comment){

    }
}
