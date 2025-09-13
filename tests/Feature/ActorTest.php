<?php

namespace Tests\Feature;

use App\Models\Actor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActorTest extends TestCase
{
    use RefreshDatabase;

    public function test_actor_form_page_loads_successfully()
    {
        $response = $this->get('/');
        
        $response->assertStatus(200);
        $response->assertViewIs('actors.create');
    }

    public function test_actors_index_page_loads_successfully()
    {
        $response = $this->get('/actors');
        
        $response->assertStatus(200);
        $response->assertViewIs('actors.index');
    }

    public function test_prompt_validation_api_endpoint_returns_correct_message()
    {
        $response = $this->getJson('/api/actors/prompt-validation');
        
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Please enter your first name and last name, and also provide your address.'
        ]);
    }

    public function test_actor_submission_validation_requires_email()
    {
        $response = $this->withoutMiddleware()->postJson('/actors', [
            'description' => 'Test description'
        ]);
        
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_actor_submission_validation_requires_description()
    {
        $response = $this->withoutMiddleware()->postJson('/actors', [
            'email' => 'test@example.com'
        ]);
        
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['description']);
    }

    public function test_actor_submission_validation_requires_unique_email()
    {
        Actor::create([
            'email' => 'existing@example.com',
            'description' => 'Existing description',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Main St'
        ]);

        $response = $this->withoutMiddleware()->postJson('/actors', [
            'email' => 'existing@example.com',
            'description' => 'New description'
        ]);
        
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_actor_submission_validation_requires_unique_description()
    {
        Actor::create([
            'email' => 'existing@example.com',
            'description' => 'Existing description',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Main St'
        ]);

        $response = $this->withoutMiddleware()->postJson('/actors', [
            'email' => 'new@example.com',
            'description' => 'Existing description'
        ]);
        
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['description']);
    }

    public function test_actor_model_fillable_attributes()
    {
        $actor = new Actor([
            'email' => 'test@example.com',
            'description' => 'Test description',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Main St',
            'height' => '6ft',
            'weight' => '180lbs',
            'gender' => 'Male',
            'age' => '30'
        ]);

        $this->assertEquals('test@example.com', $actor->email);
        $this->assertEquals('Test description', $actor->description);
        $this->assertEquals('John', $actor->first_name);
        $this->assertEquals('Doe', $actor->last_name);
        $this->assertEquals('123 Main St', $actor->address);
        $this->assertEquals('6ft', $actor->height);
        $this->assertEquals('180lbs', $actor->weight);
        $this->assertEquals('Male', $actor->gender);
        $this->assertEquals('30', $actor->age);
    }
}