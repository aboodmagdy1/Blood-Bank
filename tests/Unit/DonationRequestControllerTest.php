<?php

namespace Tests\Feature\Api;

use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Governorate;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class DonationRequestControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $client;
    protected $bloodType;
    protected $city;

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

        // assign token to client
        $this->client->api_token = 'test-token';
        $this->client->save();


    }

    /** @test */
    public function it_can_list_donation_requests()
    {
        $request = DonationRequest::create([
            'patient_name' => 'Jane Doe',
            'patient_phone' => '0987654321',
            'city_id' => $this->city->id,
            'hospital_name' => 'General Hospital',
            'hospital_address' => '123 Main St',
            'blood_type_id' => $this->bloodType->id,
            'patient_age' => 30,
            'details' => 'Urgent need for blood',
            'bags_num' => 2,
            'client_id' => $this->client->id,
            'latitude'=>30.033333,
            'longitude'=>31.233334,
            'status'=>1,
        ]);



        $response = $this->getJson('/api/v1/donation-requests', [
            'Authorization' => 'Bearer ' . $this->client->api_token
        ]);


        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'count',
                    'donation_requests' => [
                        '*' => [
                            "id",
                            "created_at",
                            "updated_at",
                            "patient_name",
                            "patient_phone",
                            "city_id",
                            "hospital_name",
                            "hospital_address",
                            "blood_type_id",
                            "patient_age",
                            "details",
                            "bags_num",
                            "latitude",
                            "longitude",
                            "client_id"
                        ]
                    ]
                ]
            ])
            ->assertJson([
                'status' => 1,
                'message' => 'success',
                
                'data' => [
                    'count' => 1,
                    'donation_requests' => [
                        [
                            'patient_name' => 'Jane Doe',
                            'patient_phone' => '0987654321',
                            'hospital_name' => 'General Hospital',
                            'hospital_address' => '123 Main St',
                            'blood_type_id' => 1,
                            'patient_age' => 30,
                            'details' => 'Urgent need for blood',
                            'bags_num' => 2,
                            'latitude' => '30.03333300',
                            'longitude' => '31.23333400',
                            'client_id' => 1
                        ]
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_create_donation_request()
    {
        $requestData = [
            'patient_name' => 'Jane Doe',
            'patient_phone' => '0987654321',
            'city_id' => $this->city->id,
            'hospital_name' => 'General Hospital',
            'hospital_address' => '123 Main St',
            'blood_type_id' => $this->bloodType->id,
            'patient_age' => 30,
            'details' => 'Urgent need for blood',
            'bags_num' => 2,
            'latitude'=>"30.033333",
            'longitude'=>"31.233334",
        ];

        $response = $this->postJson('/api/v1/donation-requests', $requestData, [
            'Authorization' => 'Bearer ' . $this->client->api_token
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'patient_name',
                    'patient_phone',
                    'city_id',
                    'hospital_name',
                    'hospital_address',
                    'blood_type_id',
                    'patient_age',
                    'details',
                    'bags_num',
                    'client_id'
                ]
            ])
            ->assertJson([
                'status' => 1,
                'message' => 'Donation request created successfully',
                'data' => [
                    'patient_name' => 'Jane Doe',
                    'patient_phone' => '0987654321',
                    'hospital_name' => 'General Hospital'
                ]
            ]);

        $this->assertDatabaseHas('donation_requests', $requestData);
    }

} 