<?php

namespace Jetstream\Curacel\Package\Interface;

use Jetstream\Curacel\DataObjects\IndividualCreditRequestData;
use Jetstream\Curacel\DataObjects\OrganisationCreditRequestData;

interface ICreditRequestService
{
    public function requestCredit(IndividualCreditRequestData|OrganisationCreditRequestData $creditRequest);
    public function getCreditRequests(array $params = []);
    public function getExtraAmount(array $params = []);
}
