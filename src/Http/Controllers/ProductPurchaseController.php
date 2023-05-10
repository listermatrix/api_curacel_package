<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\API\Interface\ICustomerService;
use Jetstream\Curacel\API\Interface\IProductService;

class ProductPurchaseController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(IProductService::class);
    }

    public  function purchaseProduct(Request $request)
    {
        $payload = $request->all();
        return $this->service->purchaseProduct($payload);
    }

    public  function listOrders()
    {
        return $this->service->getAllOrders();
    }

    public  function showOrder($orderId)
    {
        return $this->service->getOrder($orderId);
    }

    public function authorizeOrder(Request $request)
    {
        $payload = $request->all();
        return $this->service->getOrder($payload);
    }

}
