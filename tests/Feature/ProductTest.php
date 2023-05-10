<?php

namespace Jetstream\Curacel\Tests\Feature;

use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_product_types()
    {
        $response = $this->get(route('product.types'));
        $responseArray =  $response->json();

        $response->assertStatus(200);
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('data', $responseArray);

        $data = $responseArray['data'];
        $this->assertIsArray($data);
        $this->assertGreaterThan(2, count($data));
    }

    public function test_get_insurance_types()
    {

        $response = $this->get(route('product.insurance'));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseArray);

        $data = $responseArray['data'];
        $this->assertIsArray($data);
        $this->assertGreaterThan(2, count($data));
    }

    public function test_get_single_insurance_type()
    {
        $response = $this->get(route('product.show',3));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseArray);
        $this->assertIsArray($responseArray);
        $this->assertCount(1, $responseArray);
    }

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
                "dropoff_location" => "cupidatat id laboris dolore"
    ];

        $response = $this->post(route('product.purchase'),$payload);
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseArray);
        $this->assertIsArray($responseArray);
    }
}
