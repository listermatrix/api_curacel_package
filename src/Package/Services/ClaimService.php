<?php

namespace Jetstream\Curacel\Package\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\Package\Config\CuracelApiConfig;
use Jetstream\Curacel\Package\Interface\IClaimService;
use Jetstream\Curacel\DataObjects\ClaimData;
use Jetstream\Curacel\DataObjects\VoucherData;

class ClaimService extends CuracelApiConfig implements IClaimService
{
    private string $path;

    public function __construct()
    {
        parent::__construct();
        $this->path = '/claims';
    }

    /**
     * @param ClaimData $claimData
     * @return array
     */
    public function createClaim(ClaimData $claimData): array
    {
        return $this->post($this->path,$claimData->toArray());
    }

    /**
     * @param array $params
     * @return array
     */
    public function getAllClaims(array $params = []): array
    {
        return $this->get($this->path,$params);
    }

    /**
     * @param int $claimId
     * @return array
     */
    public function getClaim(int $claimId): array
    {
        return $this->get("{$this->path}/$claimId");
    }

    /**
     * @param VoucherData $voucherData
     * @return array
     */
    public function updateDischargeVoucher(VoucherData $voucherData): array
    {
        return $this->put("{$this->path}/{$voucherData->claim_id}/discharge-voucher/{$voucherData->discharge_voucher_id}",$voucherData->toArray());
    }
}
