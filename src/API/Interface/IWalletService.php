<?php

namespace Jetstream\Curacel\API\Interface;

interface IWalletService
{
    public function getBalance();
    public function getTransactions();
    public function initializeTopUp(array $payload);
}
