<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\Package\Interface\IWalletService;
use Jetstream\Curacel\DataObjects\WalletData;

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

    public  function transactions(Request $request)
    {
        $params  = $request->all();
        return $this->service->getTransactions($params);
    }

    public  function topUp(Request $request)
    {
        $payload = $request->all();
        $walletData  = new WalletData($payload['amount'],'GHS');

        return $this->service->initializeTopUp($walletData);
    }

}
