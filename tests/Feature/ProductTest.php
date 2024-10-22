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

    public function test_get_insurance_products()
    {

        $response = $this->get(route('product.insurance',['page'=>1,'per_page'=>5]));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseArray);

        $data = $responseArray['data'];

        $this->assertIsArray($data);
        $this->assertGreaterThan(4, count($data));
    }

    public function test_get_single_insurance_type()
    {
        $response = $this->get(route('product.show',3));
        $responseArray =  $response->json();
        $response->assertStatus(200);
        $this->assertArrayHasKey('data', $responseArray);
        $this->assertIsArray($responseArray);
        $this->assertCount(2, $responseArray);
    }


}
