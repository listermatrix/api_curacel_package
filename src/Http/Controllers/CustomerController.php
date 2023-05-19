<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\Package\Interface\ICustomerService;
use Jetstream\Curacel\DataObjects\IndividualCustomerData;
use Jetstream\Curacel\DataObjects\ProofOfAddressData;

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

        $customer = IndividualCustomerData::from($data);

        return $this->service->createCustomer($customer);

    }

    public  function show($reference)
    {
        return $this->service->getCustomer($reference);
    }

    public  function update(Request $request)
    {
        $data = $request->all();
        $customer =  new IndividualCustomerData(
            '',
            '',
            '',
            '',
            '',
            date('2023-01-01'),
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            new ProofOfAddressData('',''),
        );
        return $this->service->updateCustomer($customer);
    }

    public function delete($reference)
    {
        return $this->service->deleteCustomer($reference);
    }
}
