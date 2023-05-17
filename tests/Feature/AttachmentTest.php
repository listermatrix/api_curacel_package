<?php

namespace Jetstream\Curacel\Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Jetstream\Curacel\Tests\TestCase;

class AttachmentTest extends TestCase
{
    /**
     */
    public function test_upload_attachment()
    {
        Http::fake([
            config('curacel.base_url')."/attachments" => [
                "attachment" => [
                    "id" => 1,
                    "description" => "vehicle registration certificate"
                ]
            ]
        ]);
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post(route('attachment.create'), [
            'file' => $file
        ]);

        $response->assertStatus(200);
        $responseArray = $response->json();
        $this->assertIsArray($responseArray);
        $this->assertArrayHasKey('attachment', $responseArray);
    }

    public function test_get_wallet_balance()
    {
        $id = 7;
        Http::fake([
            config('curacel.base_url')."/attachments/$id" => [""]
        ]);

        $response = $this->get(route('attachment.download',$id));
        $response->assertStatus(200);
    }


}
