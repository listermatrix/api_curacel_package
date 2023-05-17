<?php

namespace Jetstream\Curacel\Tests\Feature\TD;

use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\Tests\TestCase;

class CreditRequestTest extends TestCase
{
    /**
     */
    public function test_create_credit_request_for_customer()
    {
        Http::fake([
            config('curacel.base_url')."/partners/wallet/init-topup" => [
                'data' => ['payment_link' => 'https://checkout.paystack.com/hpq3a1iw9exaj66']
            ]
        ]);
        $response = $this->post(route('wallet.topup'), ['amount' => 300.00]);

        $response->assertStatus(200);
        $responseArray = $response->json();
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('data', $responseArray);
    }

    public function test_get_all_credit_requests()
    {
        $response = $this->get(route('wallet.balance'));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey(0, $responseArray);
        $this->assertArrayHasKey('balance', $responseArray[0]);
        $this->assertArrayHasKey('currency', $responseArray[0]);
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
