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

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $category;
    protected $bloodType;
    protected $city;
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = Category::create([
            'name' => 'Test Category',
        ]);

      
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
    public function it_can_list_posts()
    {


        $post = Post::create([
            'title' => ['en' => 'Test Post', 'ar' => 'تحديث الموقع'],
            'content' => ['en' => 'Test Content', 'ar' => 'تحديث الموقع'],
            'image' => 'test.jpg',
            'category_id' => $this->category->id,
        ]);


        $response = $this->getJson('/api/v1/posts',[
            'Authorization' => 'Bearer ' . $this->client->api_token
        ]);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'content',
                    'category_id',
                    'is_favourite',
                ]
            ]
        ])->
        
        assertJson([
            'status' => 1,
            'message' => 'success',
            'data' => [
                [
                    'id' => $post->id,
                    'category_id' => $this->category->id,
                    'is_favourite' => 0,
                ]
            ]
        ]);

    
        
       
    }


} 