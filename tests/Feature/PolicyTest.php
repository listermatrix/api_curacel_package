<?php

namespace Jetstream\Curacel\Tests\Feature;

use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\Tests\TestCase;

class PolicyTest extends TestCase
{
    /**
     */
    public function test_get_all_policies_created()
    {
        Http::fake([
            config('curacel.base_url')."/policies" => [
                "data" => [
                    [
                        "id" => 8,
                        "number" => "PH-34243TF",
                        "description" => "Lorem ipsum...",
                        "start_date" => "2022-03-24",
                        "end_date" => "2023-03-24",
                        "status" => "active",
                        "document_url" => "https://grow-api.test/api/v1/policies/1/doc",
                        "customer" => [
                            "ref" => "string",
                            "email" => "string",
                            "phone" => "408-867-5309",
                            "first_name" => "Jane",
                            "last_name" => "Doe"
                        ],
                        "insurer" => [
                            "code" => "AXA",
                            "name" => "Axa Mansard",
                            "logo_url" => null,
                            "terms_conditions" => null
                        ],
                        "order" => [
                            "id" => 2,
                            "status" => "paid",
                            "amount_due" => 1470,
                            "policy_start_date" => "2022-04-06T00:00:00.000000Z",
                            "asset_ref" => "T2354354",
                            "currency" => "GHS",
                            "channel" => "Services",
                            "created_at" => "2022-04-06T10:34:20.000000Z",
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
                                "product type" => [
                                    "name" => "Goods in Transit",
                                    "slug" => "GIT"
                                ],
                                "cover-benefits" => [],
                                "created-at" => "string",
                                "price" => 0,
                                "premium-type" => "string",
                                "premium-rate-unit" => 0,
                                "premium-rate" => 0,
                                "premium" => 0,
                                "partner-commision-rate" => 0,
                                "min-premium" => "string",
                                "premium-rules" => "string",
                                "premium_frequency" => "annually"
                            ],
                            "customer" => [
                                "ref" => "string",
                                "email" => "string",
                                "phone" => "408-867-5309",
                                "first_name" => "Jane",
                                "last_name" => "Doe"
                            ],
                            "policy" => null
                        ]
                    ]
                ],
                "links" => [
                    "first" => "https://api.grow.curacel.co/policies?page=1",
                    "last" => "https://api.grow.curacel.co/policies?page=3",
                    "prev" => "https://api.grow.curacel.co/policies?page=1",
                    "next" => "https://api.grow.curacel.co/policies?page=3"
                ],
                "meta" => [
                    "current_page" => 2,
                    "from" => 1,
                    "total" => 3
                ]
            ]
        ]);
        $response = $this->get(route('policy.list'));

        $response->assertStatus(200);
        $responseArray = $response->json();
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('data', $responseArray);
    }

    public function test_get_policy_document()
    {
        $unique = 1;
        Http::fake([
            config('curacel.base_url')."/policies/$unique/doc" =>
                ['document.pdf']
        ]);

        $response = $this->get(route('policy.document',$unique));
        $response->assertStatus(200);
    }

    public function test_get_single_policy_resource()
    {

        $unique = uniqid();
        Http::fake([
            config('curacel.base_url')."/policies/$unique" =>[
                "data" => [
                    "id" => 8,
                    "number" => "PH-34243TF",
                    "description" => "Lorem ipsum...",
                    "start_date" => "2022-03-24",
                    "end_date" => "2023-03-24",
                    "status" => "active",
                    "document_url" => "https://grow-api.test/api/v1/policies/1/doc",
                    "customer" => [
                        "ref" => "string",
                        "email" => "string",
                        "phone" => "408-867-5309",
                        "first_name" => "Jane",
                        "last_name" => "Doe"
                    ],
                    "insurer" => [
                        "code" => "AXA",
                        "name" => "Axa Mansard",
                        "logo_url" => null,
                        "terms_conditions" => null
                    ],
                    "order" => [
                        "id" => 2,
                        "status" => "paid",
                        "amount_due" => 1470,
                        "policy_start_date" => "2022-04-06T00:00:00.000000Z",
                        "asset_ref" => "T2354354",
                        "currency" => "GHS",
                        "channel" => "Services",
                        "created_at" => "2022-04-06T10:34:20.000000Z",
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
                            "product type" => [
                                "name" => "Goods in Transit",
                                "slug" => "GIT"
                            ],
                            "cover-benefits" => [],
                            "created-at" => "string",
                            "price" => 0,
                            "premium-type" => "string",
                            "premium-rate-unit" => 0,
                            "premium-rate" => 0,
                            "premium" => 0,
                            "partner-commision-rate" => 0,
                            "min-premium" => "string",
                            "premium-rules" => "string",
                            "premium_frequency" => "annually"
                        ],
                        "customer" => [
                            "ref" => "string",
                            "email" => "string",
                            "phone" => "408-867-5309",
                            "first_name" => "Jane",
                            "last_name" => "Doe"
                        ],
                        "policy" => null
                    ]
                ]
            ]
        ]);

        $response = $this->get(route('policy.resource',$unique));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('data',$responseArray);
    }

}
