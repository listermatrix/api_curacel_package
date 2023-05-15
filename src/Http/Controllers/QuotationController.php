<?php

namespace Jetstream\Curacel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jetstream\Curacel\API\Interface\IQuotationService;
use Jetstream\Curacel\DataObjects\QuotationData;
use Jetstream\Curacel\DataObjects\QuotationUpdateData;

class QuotationController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(IQuotationService::class);
    }

    public  function index(Request $request)
    {
        $params = $request->all();
        return $this->service->getAllQuotations($params);
    }

    public  function create(Request $request)
    {
        $quotationData =  QuotationData::from($request->all());
        return $this->service->createQuotation($quotationData);
    }

    public  function show(Request $request,$quote)
    {
        $params = $request->all();
        return $this->service->getQuotation($quote,$params);
    }

    public function update(Request $request)
    {
        $quotationUpdateData = QuotationUpdateData::from($request->all());
        return $this->service->updateQuotation($quotationUpdateData);
    }

    public function delete(Request $request,$quote)
    {
        $params = $request->all();
        return $this->service->deleteQuotation($quote,$params);
    }

}
