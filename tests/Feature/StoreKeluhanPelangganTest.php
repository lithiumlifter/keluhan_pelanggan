<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class StoreKeluhanPelangganTest extends TestCase
{
    use RefreshDatabase;

    public function it_stores_keluhan_pelanggan_successfully()
    {
        $data = [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'nomor_hp' => '081234567890',
            'keluhan' => 'This is a test complaint.',
        ];

        $response = $this->postJson('/keluhan/store', $data);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'status' => 'success',
            'data' => [
                'nama' => 'John Doe',
                'email' => 'john@example.com',
                'nomor_hp' => '081234567890',
                'keluhan' => 'This is a test complaint.',
                'status_keluhan' => 0,
            ]
        ]);

        $this->assertDatabaseHas('keluhan_pelanggan', [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'nomor_hp' => '081234567890',
            'keluhan' => 'This is a test complaint.',
        ]);
    }

    public function it_validates_required_fields()
    {
        $data = [];

        $response = $this->postJson('/keluhan/store', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['nama', 'email', 'keluhan']);
    }

    public function it_validates_nomor_hp_field()
    {
        $data = [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'nomor_hp' => 'invalid-phone',
            'keluhan' => 'This is a test complaint.',
        ];

        $response = $this->postJson('/keluhan/store', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['nomor_hp']);
    }
}
