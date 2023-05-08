<?php

namespace Jetstream\Curacel\Http\Controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\API\Interface\ICustomerService;

class CustomerController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(ICustomerService::class);
    }

    public  function index()
    {
        return $this->service->getAllCustomers();
    }


    public  function create(Request $request)
    {
        $payload = $request->all();
        return $this->service->createCustomer($payload);
    }


    public  function show($reference)
    {
        return $this->service->getCustomer($reference);
    }

    public  function update(Request $request)
    {
        $payload = $request->all();
        return $this->service->updateCustomer($payload);
    }

    public function delete($reference)
    {
        return $this->service->deleteCustomer($reference);
    }
}
