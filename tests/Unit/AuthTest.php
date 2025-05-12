<?php

namespace Tests\Feature\Api;

use App\Models\City;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Category;
use App\Models\BloodType;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected $bloodType;
    protected $city;
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();


      
            $this->bloodType = BloodType::create(['name' => 'A+']);
            $governorate = Governorate::create(['name' => 'Cairo']);
            $this->city = City::create([
                'name' => 'Maadi',
                'governorate_id' => $governorate->id
            ]);
    
            // Create a client and generate token
            $this->client = Client::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '1234567890',
                'password' => 'password',
                'api_token' => 'test-token',
                'blood_type_id' => $this->bloodType->id,
                'd_o_b' => '1990-01-01',
                'gender' => 'male',
                'last_donation_date' => '2023-01-01',
                'city_id' => $this->city->id,
    
            ]);
            $this->client->api_token = 'test-token';
            $this->client->save();

    }

    /** @test */
    public function it_can_login()
    {


      $response = $this->postJson('/api/v1/login',[
        'email' => 'test@example.com',
        'password' => 'password',
      ]);

      $response->assertJsonStructure([
        'status',
        'message',
        'data' => [
            'api_token',
            'client' => [
                'name',
                'email',
                'phone',
                'blood_type_id',
            ]
        ]
      ])->assertJson([
        'status' => 1,
        'message' => 'logged in successfully',
        'data' => [
            'client' => [
                'name' => $this->client->name,
                'email' => $this->client->email,
                'phone' => $this->client->phone,
                'blood_type_id' => $this->client->blood_type_id,
            ]
        ]
      ]);
        
    
        
       
    }


} 