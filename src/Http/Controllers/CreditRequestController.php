<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\DataObjects\IndividualCreditRequestData;
use Jetstream\Curacel\Package\Interface\ICreditRequestService;
use Jetstream\Curacel\DataObjects\IndividualCustomerData;
use Jetstream\Curacel\DataObjects\ProofOfAddressData;

class CreditRequestController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(ICreditRequestService::class);
    }

    public  function index(Request $request)
    {
        $params = $request->all();
        return $this->service->getCreditRequests($params);
    }


    public  function create(Request $request)
    {
        $creditRequest = IndividualCreditRequestData::from($request->all());

        return $this->service->requestCredit($creditRequest);
    }

    public  function getMarkAmount(Request $request)
    {
        $params = $request->all();
        return $this->service->getExtraAmount($params);
    }
}
