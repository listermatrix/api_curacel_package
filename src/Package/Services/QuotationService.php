<?php

namespace Jetstream\Curacel\Package\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\Package\Config\CuracelApiConfig;
use Jetstream\Curacel\Package\Interface\IQuotationService;
use Jetstream\Curacel\Package\Interface\IWalletService;
use Jetstream\Curacel\DataObjects\ConvertQuoteData;
use Jetstream\Curacel\DataObjects\QuotationData;
use Jetstream\Curacel\DataObjects\QuotationUpdateData;
use Jetstream\Curacel\DataObjects\WalletData;

class QuotationService extends CuracelApiConfig implements IQuotationService
{

    private string $path;

    public function __construct()
    {
        parent::__construct();
        $this->path = '/quotes';
    }

    /**
     * @param QuotationData $quotationData
     * @return array
     */
    public function createQuotation(QuotationData $quotationData): array
    {
        return $this->post($this->path,$quotationData->toArray());
    }

    /**
     * @param QuotationUpdateData $quotationUpdateData
     * @return array
     */
    public function updateQuotation(QuotationUpdateData $quotationUpdateData)
    {
        return $this->patch($this->path,$quotationUpdateData->toArray());
    }

    /**
     * @param array $params
     * @return array
     */
    public function getAllQuotations(array $params = []): array
    {
        return $this->get($this->path,$params);
    }

    /**
     * @param ConvertQuoteData $convertQuoteData
     * @return array
     */
    public function convertQuotation(ConvertQuoteData $convertQuoteData): array
    {
        return $this->post("{$this->path}/accept",$convertQuoteData->toArray());
    }

    /**
     * @param string $quote
     * @param array $params
     * @return array
     */
    public function downloadQuotationInvoice(string $quote, array $params = []): array
    {
        return $this->get("{$this->path}/{$quote}/invoice",$params);
    }

    /**
     */
    public function getQuotation(string $quote, array $params = []): array
    {
        return $this->get("{$this->path}/{$quote}",$params);
    }

    /**
     * @param string $quote
     * @param array $params
     * @return array
     */
    public function deleteQuotation(string $quote, array $params = []): array
    {
        return $this->delete("{$this->path}/{$quote}",$params);
    }
}
