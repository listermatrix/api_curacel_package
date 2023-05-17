<?php

namespace Jetstream\Curacel\Tests\Feature;

use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\Tests\TestCase;

class ClaimTest extends TestCase
{
    /**
     */
    public function test_create_claim_from_policy()
    {
        Http::fake([
            config('curacel.base_url')."/claims" => [
                "claim" => [
                    "id" => 8,
                    "status" => "processing",
                    "policy" => [
                        "id" => 8,
                        "number" => "PH-34243TF",
                        "description" => "Lorem ipsum...",
                        "start_date" => "2022-03-24",
                        "end_date" => "2023-03-24",
                        "status" => "active"
                    ],
                    "amount_requested" => "239832.00",
                    "amount_approved" => "100000.00",
                    "currency" => "EUR",
                    "created_at" => "2022-03-12T14:19:50.000000Z"
                ]
            ]
        ]);
        $response = $this->post(route('claim.create'),
            [
                "policy_number" => "12903io20",
                "payment_details" => [
                    "bank_name" => "first bank",
                    "account_number" => "fugiat sit deserunt",
                    "sort_code" => 901290
                ],
                "amount" => 10000.2,
                "attachments" => [210, 210]
            ]
        );

        $response->assertStatus(200);
        $responseArray = $response->json();
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('claim', $responseArray);
    }

    public function test_list_claims()
    {

        Http::fake([
            config('curacel.base_url')."/claims" => [
                "data" => [
                    [
                    "id" => 8,
                    "status" => "processing",
                    "policy" => [
                        "id" => 8,
                        "number" => "PH-34243TF",
                        "description" => "Lorem ipsum...",
                        "start_date" => "2022-03-24",
                        "end_date" => "2023-03-24",
                        "status" => "active"
                    ],
                    "amount_requested" => "239832.00",
                    "amount_approved" => "100000.00",
                    "currency" => "EUR",
                    "created_at" => "2022-03-12T14:19:50.000000Z"
                ]
                ]
            ]
        ]);

        $response = $this->get(route('claim.list'));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseArray);
    }

    public function test_get_claim()
    {

        $claimID = 1;
        Http::fake([
            config('curacel.base_url')."/claims/$claimID" => [
                "data" =>
                    [
                        "id" => 8,
                        "status" => "processing",
                        "policy" => [
                            "id" => 8,
                            "number" => "PH-34243TF",
                            "description" => "Lorem ipsum...",
                            "start_date" => "2022-03-24",
                            "end_date" => "2023-03-24",
                            "status" => "active"
                        ],
                        "amount_requested" => "239832.00",
                        "amount_approved" => "100000.00",
                        "currency" => "EUR",
                        "created_at" => "2022-03-12T14:19:50.000000Z"
                    ]
            ]
        ]);

        $response = $this->get(route('claim.show',$claimID));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseArray);
    }

    public function test_update_a_discharge_voucher()
    {
        $claim_id = 1;
        $voucher_id = 1;
        Http::fake([
            config('curacel.base_url')."/claims/$claim_id/discharge-voucher/$voucher_id" => [
                "data" => [
                        "id" => 8,
                        "status" => "processing",
                        "policy" => [
                            "id" => 8,
                            "number" => "PH-34243TF",
                            "description" => "Lorem ipsum...",
                            "start_date" => "2022-03-24",
                            "end_date" => "2023-03-24",
                            "status" => "active"
                        ],
                        "amount_requested" => "239832.00",
                        "amount_approved" => "100000.00",
                        "currency" => "EUR",
                        "created_at" => "2022-03-12T14:19:50.000000Z"
                    ]
            ]
        ]);
        $response = $this->put(route('claim.voucher.update'),
            [
                "claim_id" => $claim_id,
                "discharge_voucher_id" => $voucher_id,
                "status" => "approved",
                "comment" => "lorem ipsum dolor sit amet, consectetur adip"
            ]
        );

        $response->assertStatus(200);
        $responseArray = $response->json();
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('data', $responseArray);
    }

}
