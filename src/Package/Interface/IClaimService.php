<?php

namespace Jetstream\Curacel\Package\Interface;

use Jetstream\Curacel\DataObjects\ClaimData;
use Jetstream\Curacel\DataObjects\VoucherData;

interface IClaimService
{
    public function createClaim(ClaimData $claimData);
    public function getAllClaims(array $params = []);
    public function getClaim(int $claimId);
    public function updateDischargeVoucher(VoucherData $voucherData);
}
