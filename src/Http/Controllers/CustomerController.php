<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\API\Interface\ICustomerService;
use Jetstream\Curacel\Models\Customer;

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
        $data = $request->all();
        $customer = new Customer;

        foreach ($data as $key => $value) {
            $customer->$key = $value;
        }

        return $this->service->createCustomer($customer);
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
