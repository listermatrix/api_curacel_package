<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\Package\Interface\IQuotationService;
use Jetstream\Curacel\DataObjects\ConvertQuoteData;

class QuotationActionController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(IQuotationService::class);
    }

    public  function downloadQuotationInvoice(Request $request,$quote)
    {
        $params = $request->all();
        return $this->service->downloadQuotationInvoice($quote,$params);
    }

    public  function convertQuotation(Request $request)
    {
        $convertQuoteData =  ConvertQuoteData::from($request->all());
        return $this->service->convertQuotation($convertQuoteData);
    }

}
