<?php

namespace Jetstream\Curacel\API\Interface;

use Jetstream\Curacel\DataObjects\WalletData;

interface IWalletService
{
    public function getBalance();
    public function getTransactions(array $params = []);
    public function initializeTopUp(WalletData $walletData);
}
