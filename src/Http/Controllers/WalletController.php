<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\API\Interface\IWalletService;

class WalletController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(IWalletService::class);
    }

    public  function balance()
    {
        return $this->service->getBalance();
    }

    public  function transactions()
    {
        return $this->service->getTransactions();
    }

    public  function topUp(Request $request)
    {   $payload = $request->all();
        return $this->service->initializeTopUp($payload);
    }

}
