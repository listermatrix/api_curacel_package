<?php

namespace Jetstream\Curacel\API\Interface;

use Jetstream\Curacel\DataObjects\ConvertQuoteData;
use Jetstream\Curacel\DataObjects\QuotationData;
use Jetstream\Curacel\DataObjects\QuotationUpdateData;

interface IQuotationService
{
    public function createQuotation(QuotationData $quotationData);

    public function updateQuotation(QuotationUpdateData $quotationUpdateData);

    public function getAllQuotations(array $params = []);

    public function convertQuotation(ConvertQuoteData $convertQuoteData);

    public function downloadQuotationInvoice(string $quote,array $params = []);

    public function getQuotation(string $quote,array $params = []);

    public function deleteQuotation(string $quote,array $params = []);
}
