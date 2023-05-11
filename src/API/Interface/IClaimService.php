<?php

namespace Jetstream\Curacel\API\Interface;

interface IClaimService
{
    public function createClaim();
    public function getAllClaims();
    public function getClaim();
    public function updateDischargeVoucher();
}
