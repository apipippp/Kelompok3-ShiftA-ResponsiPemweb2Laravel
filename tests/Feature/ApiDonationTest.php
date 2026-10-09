<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiDonationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_via_api_and_receive_token(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'API Tester',
            'email' => 'apitester@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'phone' => '081234567890',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'access_token',
                'token_type',
                'user' => ['id', 'name', 'email', 'role'],
            ]);
    }

    public function test_user_can_login_via_api_and_access_protected_endpoints(): void
    {
        $user = User::factory()->create([
            'email' => 'donor@example.com',
            'password' => bcrypt('password123'),
            'role' => 'donatur',
        ]);

        $loginResponse = $this->postJson('/api/login', [
            'email' => 'donor@example.com',
            'password' => 'password123',
        ]);

        $loginResponse->assertStatus(200);
        $token = $loginResponse->json('access_token');
        $this->assertNotEmpty($token);

        // Test protected /api/user
        $userResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/user');

        $userResponse->assertStatus(200)
            ->assertJsonPath('user.email', 'donor@example.com');
    }

    public function test_donor_can_create_and_fetch_donations_via_api(): void
    {
        $donor = User::factory()->create(['role' => 'donatur']);
        $token = $donor->createToken('test_token')->plainTextToken;

        // Create donation
        $storeResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/donations', [
                'donor_name' => 'Budi Santoso',
                'donor_phone' => '081234567890',
                'clothing_type' => 'Kaos & T-Shirt',
                'quantity' => 5,
                'condition' => 'sangat_baik',
                'delivery_method' => 'antar_posko',
                'notes' => 'Pakaian anak usia 7 tahun',
            ]);

        $storeResponse->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => ['id', 'tracking_code', 'donor_name', 'quantity', 'status'],
            ]);

        $code = $storeResponse->json('data.tracking_code');

        // Test public tracking endpoint without token
        $trackResponse = $this->getJson('/api/tracking/' . $code);
        $trackResponse->assertStatus(200)
            ->assertJsonPath('data.tracking_code', $code);

        // Test list donations with token
        $listResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/donations');

        $listResponse->assertStatus(200)
            ->assertJsonPath('pagination.total', 1);
    }
}
