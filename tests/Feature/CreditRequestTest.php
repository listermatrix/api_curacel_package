<?php

namespace Jetstream\Curacel\Tests\Feature;

use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\Tests\TestCase;

class CreditRequestTest extends TestCase
{
    /**
     */
    public function test_create_credit_request_for_customer()
    {
        Http::fake([
            config('curacel.base_url')."/insurance-credit-requests" => [
              "data" => [
                "credits_issued" => 10.5,
                "total_amount_paid" => 20200,
                "item_original_price" => 20000,
                "markup_amount" => 200,
                "markup_config" => [
                    "rate" => "1%",
                    "max_cap" => 1000
                ],
                "currency" => "NGN"
              ]
            ]
        ]);


        $response = $this->post(route('credit.create'), [
            "total_amount_paid" => 5378899.955527976,
            "ref" => "minim nostrud cupidatat",
            "customer" => [
                "email" => "amet",
                "ref" => "et Excepteur",
                "first_name" => "Jane",
                "last_name" => "Doe",
                "phone" => "408-867-5309",
                "birth_date" => "2021-03-03"
            ],
            "item_original_price" => -15618168.827978745,
            "narration" => "minim laboris adipisicing esse"
        ]);

        $response->assertStatus(200);
        $responseArray = $response->json();
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('data', $responseArray);
    }

    public function test_get_all_credit_requests()
    {
        Http::fake([
            config('curacel.base_url')."/insurance-credit-requests" => [
                "data" => [
                    [
                        "ref" => "abcd1234",
                        "credits_earned" => 123,
                        "currency" => "NGN",
                        "original_price" => 1500,
                        "markup_amount" => 50.49,
                        "status" => "completed",
                        "created_at" => "2023-05-16",
                        "customer" => [
                            "ref" => "string",
                            "email" => "string",
                            "phone" => "408-867-5309",
                            "first_name" => "Jane",
                            "last_name" => "Doe"
                        ]
                    ]
                ]
            ]
        ]);
        $response = $this->get(route('credit.index'));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseArray);
    }

    public function test_get_extra_request_extra_amount()
    {
        Http::fake([
            config('curacel.base_url')."/insurance-credit-requests/markup-amount" => [
                'amount' => 0.49
            ]
        ]);

        $response = $this->get(route('credit.amount'));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('amount',$responseArray);
    }

}
