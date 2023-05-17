<?php

namespace Jetstream\Curacel\Tests\Feature;

use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\Tests\TestCase;

class QuotationTest extends TestCase
{
    /**
     */
    public function test_get_all_quotations()
    {
        Http::fake([
            config('curacel.base_url')."/quotes" => [
                'data' => [
                    [
                        'id' => 2,
                        'ref' => 'q-partner-one-1',
                        'status' => 'paid',
                        'amount_due' => 1470,
                        'policy_start_date' => '2022-04-06T00:00:00.000000Z',
                        'product_price' => 1500,
                        'asset_ref' => 'T2354354',
                        'currency' => 'GHS',
                        'created_at' => '2022-04-06T10:34:20.000000Z',
                        'company_name' => 'Curacel Inc.',
                        'product' => [
                            'title' => 'Comprehensive Car Plan XYZ',
                            'code' => 'auto-com-xyz',
                            'id' => 1,
                            'insurer' => [
                                'code' => 'AXA',
                                'name' => 'Axa Mansard',
                                'logo_url' => null,
                                'terms_conditions' => null
                            ],
                            'product type' => [
                                'name' => 'Goods in Transit',
                                'slug' => 'GIT'
                            ],
                            'cover-benefits' => [],
                            'created-at' => 'string',
                            'price' => 0,
                            'premium-type' => 'string',
                            'premium-rate-unit' => 0,
                            'premium-rate' => 0,
                            'premium' => 0,
                            'partner-commision-rate' => 0,
                            'min-premium' => 'string',
                            'premium-rules' => 'string',
                            'premium_frequency' => 'annually'
                        ],
                        'customer' => [
                            'ref' => 'string',
                            'email' => 'string',
                            'phone' => '408-867-5309',
                            'first_name' => 'Jane',
                            'last_name' => 'Doe'
                        ]
                    ]
                ],
                'links' => [
                    'first' => 'https://api.grow.curacel.co/quotes?page=1',
                    'last' => 'https://api.grow.curacel.co/quotes?page=3',
                    'prev' => 'https://api.grow.curacel.co/quotes?page=1',
                    'next' => 'https://api.grow.curacel.co/quotes?page=3'
                ],
                'meta' => [
                    'current_page' => 2,
                    'from' => 1,
                    'total' => 3
                ]
            ]

        ]);
        $response = $this->get(route('quotation.index'));

        $response->assertStatus(200);
        $responseArray = $response->json();
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('data', $responseArray);
    }

    public function test_create_quotations()
    {
        Http::fake([ config('curacel.base_url')."/quotes" =>
            [
                "message" => "Quote created successfully",
                "quote" => [
                    "id" => 23,
                    "asset_ref" => "rwt345",
                    "product_price" => 1200.89,
                    "partner_commission" => 20.76,
                    "partner_commission_rate" => 2,
                    "amount_due" => 1180.13,
                    "currency" => "NGN",
                    "company_name" => "Curacel Inc.",
                    "description" => "lorem ipsum...",
                    "policy_start_date" => "2022-05-25T00:00:00.000000Z"
                ]
            ]
        ]);
        $response = $this->post(route('quotation.create'),
            [
                "product_code" => "s-credit-life",
                "customer_ref" => "PartnerOne_2",
                "policy_start_date" => "2022-05-25",
                "asset_value" => 43534,
                "payment_type" => "wallet",
                "pickup_location" => "aliqua eu sit eiusm",
                "dropoff_location" => "ut",
                "asset_ref" => "rwt345",
                "attachments" => [12, 34],
                "broker_premium_rate" => 20850.5,
                "broker_taxes" => 2
            ]
        );
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertEquals('Quote created successfully', $responseArray['message']);
    }

    public function test_view_quotation()
    {

        $quote = uniqid();
        Http::fake([
            config('curacel.base_url')."/quotes/$quote" => [
                "data" => [
                    [
                        "id" => 2,
                        "ref" => "q-partner-one-1",
                        "status" => "paid",
                        "amount_due" => 1470,
                        "policy_start_date" => "2022-04-06T00:00:00.000000Z",
                        "product_price" => 1500,
                        "asset_ref" => "T2354354",
                        "currency" => "GHS",
                        "created_at" => "2022-04-06T10:34:20.000000Z",
                        "company_name" => "Curacel Inc.",
                        "product" => [
                            "title" => "Comprehensive Car Plan XYZ",
                            "code" => "auto-com-xyz",
                            "id" => 1,
                            "insurer" => [
                                "code" => "AXA",
                                "name" => "Axa Mansard",
                                "logo_url" => null,
                                "terms_conditions" => null
                            ],
                            "product_type" => [
                                "name" => "Goods in Transit",
                                "slug" => "GIT"
                            ],
                            "cover_benefits" => [],
                            "created_at" => "string",
                            "price" => 0,
                            "premium_type" => "string",
                            "premium_rate_unit" => 0,
                            "premium_rate" => 0,
                            "premium" => 0,
                            "partner_commision_rate" => 0,
                            "min_premium" => "string",
                            "premium_rules" => "string",
                            "premium_frequency" => "annually"
                        ],
                        "customer" => [
                            "ref" => "string",
                            "email" => "string",
                            "phone" => "408-867-5309",
                            "first_name" => "Jane",
                            "last_name" => "Doe"
                        ]
                    ]
                ],
                "links" => [
                    "first" => "https://api.grow.curacel.co/quotes?page=1",
                    "last" => "https://api.grow.curacel.co/quotes?page=3",
                    "prev" => "https://api.grow.curacel.co/quotes?page=1",
                    "next" => "https://api.grow.curacel.co/quotes?page=3"
                ],
                "meta" => [
                    "current_page" => 2,
                    "from" => 1,
                    "total" => 3
                ]
            ]
        ]);
        $response = $this->get(route('quotation.show',$quote));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('data',$responseArray);
    }

    public function test_update_quotation()
    {

        $quote = uniqid();
        Http::fake([
            config('curacel.base_url')."/quotes" => [
                'data' => [
                    "id" => 2,
                    "ref" => "q-partner-one-1",
                    "status" => "paid",
                    "amount_due" => 1470,
                    "policy_start_date" => "2022-04-06T00:00:00.000000Z",
                    "product_price" => 1500,
                    "asset_ref" => "T2354354",
                    "currency" => "GHS",
                    "created_at" => "2022-04-06T10:34:20.000000Z",
                    "company_name" => "Curacel Inc.",
                    "product" => [
                        "title" => "Comprehensive Car Plan XYZ",
                        "code" => "auto-com-xyz",
                        "id" => 1,
                        "insurer" => [
                            "code" => "AXA",
                            "name" => "Axa Mansard",
                            "logo_url" => null,
                            "terms_conditions" => null
                        ],
                        "product_type" => [
                            "name" => "Goods in Transit",
                            "slug" => "GIT"
                        ],
                        "cover_benefits" => [],
                        "created_at" => "string",
                        "price" => 0,
                        "premium_type" => "string",
                        "premium_rate_unit" => 0,
                        "premium_rate" => 0,
                        "premium" => 0,
                        "partner_commision_rate" => 0,
                        "min_premium" => "string",
                        "premium_rules" => "string",
                        "premium_frequency" => "annually"
                    ],
                    "customer" => [
                        "ref" => "string",
                        "email" => "string",
                        "phone" => "408-867-5309",
                        "first_name" => "Jane",
                        "last_name" => "Doe"
                    ]
                ]
            ]
        ]);
        $response = $this->patch(route('quotation.update',$quote),
            ['ref' =>uniqid(),'$customer_ref' => uniqid()]
        );
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('data',$responseArray);
    }

    public function test_delete_quotation()
    {

        $quote = uniqid();
        Http::fake([
            config('curacel.base_url')."/quotes/$quote" => [
                'message' => "Quote deleted successfully"
            ]
        ]);
        $response = $this->delete(route('quotation.delete',$quote));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('message',$responseArray);
    }

    public function test_convert_quote_to_an_order()
    {
        Http::fake([
            config('curacel.base_url')."/quotes/accept" => [
                "order" => [
                    "id" => 23,
                    "asset_ref" => "rwt345",
                    "product_price" => 1200.89,
                    "partner_commission" => 20.76,
                    "amount_due" => 1180.13,
                    "currency" => "NGN",
                    "payment_instructions" => [
                        "message" => "Payment successful",
                        "success" => true
                    ],
                    "payment_gateway_charge" => null
                ]
            ]
        ]);
        $response = $this->post(route('quotation.convert'),
            [
                "ref" => "q-partner-1",
                "asset_ref" => "rwt345",
                "customer_ref" => "PartnerOne_2",
                "policy_start_date" => "2022-04-28",
                "payment_type" => "wallet",
                "attachments" => [12, 34]
            ]
        );
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('order',$responseArray);
    }
    public function test_download_invoice_for_quote()
    {
        $quote = uniqid();
        Http::fake([
            config('curacel.base_url')."/quotes/$quote/invoice" => [
               'JVBERi0xLjQKJeLjz9MKMyAwIG9iago8PC.pdf'
            ]
        ]);
        $response = $this->get(route('quotation.downloadInvoice',$quote));
        $response->assertStatus(200);
    }

}
