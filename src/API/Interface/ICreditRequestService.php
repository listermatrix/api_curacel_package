<?php

namespace Jetstream\Curacel\API\Interface;

use Jetstream\Curacel\DataObjects\CreditRequestData;

interface ICreditRequestService
{
    public function requestCredit(CreditRequestData $creditRequest);
    public function getCreditRequests(array $params = []);
    public function getExtraAmount(array $params = []);
}
