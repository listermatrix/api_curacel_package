<?php

namespace Jetstream\Curacel\API\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\IClaimService;
use Jetstream\Curacel\API\Interface\ICustomerService;
use Jetstream\Curacel\DataObjects\ClaimData;
use Jetstream\Curacel\DataObjects\CuracelCustomer;
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
     * @throws RequestException
     */
    public function createClaim(ClaimData $claimData)
    {
        return $this->post($this->path,$claimData->toArray());
    }

    /**
     * @throws RequestException
     */
    public function getAllClaims(array $params = [])
    {
        return $this->get($this->path,$params);
    }

    /**
     * @throws RequestException
     */
    public function getClaim(int $claimId)
    {
        return $this->get("{$this->path}/$claimId");
    }

    /**
     * @throws RequestException
     */
    public function updateDischargeVoucher(VoucherData $voucherData)
    {
        return $this->put("{$this->path}/{$voucherData->claim_id}/discharge-voucher/{$voucherData->discharge_voucher_id}",$voucherData->toArray());
    }
}
