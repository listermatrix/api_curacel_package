<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\Package\Interface\IClaimService;
use Jetstream\Curacel\DataObjects\ClaimData;
use Jetstream\Curacel\DataObjects\VoucherData;

class ClaimController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(IClaimService::class);
    }

    public  function index(Request $request)
    {
        $params = $request->all();
        return $this->service->getAllClaims($params);
    }

    public  function create(Request $request)
    {
        $params = ClaimData::from($request->all());
        return $this->service->createClaim($params);
    }

    public  function showClaim($id)
    {
        return $this->service->getClaim($id);
    }

    public  function updateVoucher(Request $request)
    {
        $data = VoucherData::from($request->all());
        return $this->service->updateDischargeVoucher($data);
    }

}
