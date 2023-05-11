<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\API\Interface\IClaimService;

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
        return $this->service->getAllPolicies($params);
    }

    public  function create(Request $request)
    {
        $params = $request->all();
        return $this->service->getAllPolicies($params);
    }

    public  function showClaim($id)
    {
        return $this->service->getPolicyDocument($id);
    }

    public  function updateVoucher(Request $request,$identifier)
    {
        $params = $request->all();
        return $this->service->getPolicyResource($identifier,$params);
    }

}
