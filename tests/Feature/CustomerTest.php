<?php

namespace Jetstream\Curacel\Tests\Feature;

use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\Tests\TestCase;

class CustomerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_customers()
    {
        Http::fake([
            config('curacel.base_url')."/customers" => [
                'data' =>
                    [
                        'id' => 7948,
                        'ref' => 'jetstream_6Pf57Lj3iTNvrSJV',
                        'first_name' => 'Mel',
                        'last_name' => 'Zedek',
                        'birth_date' => '2023-04-13',
                        'email' => 'mob@jetstreamafrica.com',
                        'phone' => '+233203450921',
                        'sex' => 'M',
                        'residential_address' => 'Teshie',
                        'next_of_kin_name' => 'Stan',
                        'next_of_kin_phone' => '+233203450921',
                    ],
                    [
                        'id' => 7949,
                        'ref' => '56857w8875',
                        'first_name' => 'Rich',
                        'last_name' => 'Zedek',
                        'birth_date' => '2023-04-13',
                        'email' => 'tbo@jetstreamafrica.com',
                        'phone' => '+233203450921',
                        'sex' => 'M',
                        'residential_address' => 'Teshie',
                        'next_of_kin_name' => 'Stan',
                        'next_of_kin_phone' => '+233203450921',
                ],
            ],
        ]);

        $response = $this->get(route('customer.index'));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertIsArray($responseArray);
        $this->assertCount(2, $responseArray);
    }

    public function test_get_single_customer()
    {
        $customerReference  = uniqid();
        Http::fake([
            config('curacel.base_url')."/customers/$customerReference" => [
                'data' =>
                    [
                        'id' => 7948,
                        'ref' => 'jetstream_6Pf57Lj3iTNvrSJV',
                        'first_name' => 'Mel',
                        'last_name' => 'Zedek',
                        'birth_date' => '2023-04-13',
                        'email' => 'mob@jetstreamafrica.com',
                        'phone' => '+233203450921',
                        'sex' => 'M',
                        'residential_address' => 'Teshie',
                        'next_of_kin_name' => 'Stan',
                        'next_of_kin_phone' => '+233203450921',
                    ],
            ],
        ]);

        $response = $this->get(route('customer.show',$customerReference));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertIsArray($responseArray);
        $this->assertCount(1, $responseArray);
    }

    public function test_create_customer()
    {
        Http::fake([
            config('curacel.base_url')."/customers" => [
                'data' => [
                        'id' => 7948,
                        'ref' => 'jetstream_6Pf57Lj3iTNvrSJV',
                        'first_name' => 'Mel',
                        'last_name' => 'Zedek',
                        'birth_date' => '2023-04-13',
                        'email' => 'mob@jetstreamafrica.com',
                        'phone' => '+233203450921',
                        'sex' => 'M',
                        'residential_address' => 'Teshie',
                        'next_of_kin_name' => 'Stan',
                        'next_of_kin_phone' => '+233203450921',
                    ],
            ],
        ]);

        $response = $this->postJson(route('customer.create'), [
            'first_name' => 'Mel',
            'last_name' => 'Zedek',
            'birth_date' => '2023-04-13',
            'email' => 'mob@jetstreamafrica.com',
            'phone' => '+233203450921',
            'sex' => 'M',
            'residential_address' => 'Teshie',
            'next_of_kin_name' => 'Stan',
            'next_of_kin_phone' => '+233203450921',
        ]);
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertIsArray($responseArray);
        $this->assertCount(1, $responseArray);
    }

    public function test_delete_customer()
    {
        $customerReference  = uniqid();
        Http::fake();
        $response = $this->delete(route('customer.delete',$customerReference));
        $response->assertStatus(200);
    }
}
