<?php

namespace Jetstream\Curacel\Tests\Feature;

use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\Tests\TestCase;

class ProductPurchaseTest extends TestCase
{
    public function test_purchase_insurance_product()
    {
        Http::fake([
            config('curacel.base_url')."/orders" => [
                'data' => [
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
                        "payment_gateway_charge" => 24441968.15116197
                    ]
                ]]
        ]);

        $payload = [
            "product_code" => "435te",
            "customer_ref" => "189jwsf7",
            "payment_type" => "wallet",
            "policy_start_date" => "2022-04-28",
            "asset_value" => 12500.58,
            "trip_frequency" => "recurring",
            "trips_per_day" => 92155490,
            "trip_days_per_year" => -64146670,
            "pickup_location" => "fugiat est ullamco tempor",
            "dropoff_location" => "cupidatat id laboris dolore",
        ];

        $response = $this->post(route('product.purchase'),$payload);
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseArray);
        $this->assertIsArray($responseArray);
    }
    public function test_get_all_orders_for_customer()
    {
        Http::fake([
            config('curacel.base_url')."/orders" => [
                "orders" => [
                    [
                        "id" => 2,
                        "status" => "paid",
                        "amount_due" => 1470,
                        "policy_start_date" => "2022-04-06T00:00:00.000000Z",
                        "asset_ref" => "T2354354",
                        "currency" => "GHS",
                        "channel" => "API",
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

        $response = $this->get(route('products.orders.list'));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('orders', $responseArray);
        $this->assertIsArray($responseArray);
    }

    public function test_get_an_orders_for_a_customer()
    {
        $ref = 7;
        Http::fake([
            config('curacel.base_url')."/orders/$ref" => [
                "order" => [
                    "id" => 2,
                    "status" => "paid",
                    "amount_due" => 1470,
                    "policy_start_date" => "2022-04-06T00:00:00.000000Z",
                    "asset_ref" => "T2354354",
                    "currency" => "GHS",
                    "channel" => "API",
                    "created_at" => "2022-04-06T10:34:20.000000Z",
                    "payment_made_at" => "2022-04-06T10:34:20.000000Z",
                    "payment_method" => "wallet",
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
        ]);

        $response = $this->get(route('products.orders.show',$ref));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('order', $responseArray);
        $this->assertIsArray($responseArray);
    }

    public function test_authorize_an_order()
    {
        $ref = 2;
        Http::fake([
            config('curacel.base_url')."/orders/authorize" => [
                "order" => [
                    "id" => 2,
                    "status" => "paid",
                    "amount_due" => 1470,
                    "policy_start_date" => "2022-04-06T00:00:00.000000Z",
                    "asset_ref" => "T2354354",
                    "currency" => "GHS",
                    "channel" => "API",
                    "created_at" => "2022-04-06T10:34:20.000000Z",
                    "payment_made_at" => "2022-04-06T10:34:20.000000Z",
                    "payment_method" => "wallet",
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
        ]);

        $response = $this->post(route('products.orders.authorize'),
            [
                'id' => $ref
            ]
        );
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('order', $responseArray);
        $this->assertIsArray($responseArray);
    }
}
