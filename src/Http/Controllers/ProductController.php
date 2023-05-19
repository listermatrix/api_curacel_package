<?php

namespace Jetstream\Curacel\Http\Controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\Package\Interface\ICustomerService;
use Jetstream\Curacel\Package\Interface\IProductService;

class ProductController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(IProductService::class);
    }

    public  function getInsuranceProducts(Request $request)
    {
        $params = $request->all();
        return $this->service->getAllInsuranceProducts($params);
    }

    public  function getProductTypes()
    {
        return $this->service->getAllProductTypes();
    }

    public  function showInsuranceProduct($id)
    {
        return $this->service->getInsuranceProduct($id);
    }

}
