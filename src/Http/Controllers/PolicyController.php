<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\API\Interface\IPolicyService;

class PolicyController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(IPolicyService::class);
    }

    public  function getCustomerPolicies(Request $request)
    {
        $params = $request->all();
        return $this->service->getAllPolicies($params);
    }

    public  function getPolicyDocument($id)
    {
        return $this->service->getPolicyDocument($id);
    }

    public  function getPolicyResource(Request $request,$identifier)
    {
        $params = $request->all();
        return $this->service->getPolicyResource($identifier,$params);
    }

}
