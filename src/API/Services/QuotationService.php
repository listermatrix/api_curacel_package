<?php

namespace Jetstream\Curacel\API\Services;

use Illuminate\Http\Client\RequestException;
use Jetstream\Curacel\API\Config\CuracelApiConfig;
use Jetstream\Curacel\API\Interface\IQuotationService;
use Jetstream\Curacel\API\Interface\IWalletService;
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
     * @throws RequestException
     */
    public function createQuotation(QuotationData $quotationData)
    {
        return $this->post($this->path,$quotationData->toArray());
    }

    /**
     * @throws RequestException
     */
    public function updateQuotation(QuotationUpdateData $quotationUpdateData)
    {
        return $this->patch($this->path,$quotationUpdateData->toArray());
    }

    /**
     * @throws RequestException
     */
    public function getAllQuotations(array $params = [])
    {
        return $this->get($this->path,$params);
    }

    /**
     * @throws RequestException
     */
    public function convertQuotation(ConvertQuoteData $convertQuoteData)
    {
        return $this->post("{$this->path}/accept",$convertQuoteData->toArray());
    }

    /**
     * @throws RequestException
     */
    public function downloadQuotationInvoice(string $quote, array $params = [])
    {
        return $this->get("{$this->path}/{$quote}/invoice",$params);
    }

    /**
     * @throws RequestException
     */
    public function getQuotation(string $quote, array $params = [])
    {
        return $this->get("{$this->path}/{$quote}",$params);
    }

    /**
     * @throws RequestException
     */
    public function deleteQuotation(string $quote, array $params = [])
    {
        return $this->delete("{$this->path}/{$quote}",$params);
    }
}
