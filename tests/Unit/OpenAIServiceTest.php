<?php

namespace Tests\Unit;

use App\Services\OpenAIService;
use Tests\TestCase;

class OpenAIServiceTest extends TestCase
{
    private OpenAIService $openAIService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->openAIService = new OpenAIService();
    }

    public function test_validate_required_fields_returns_true_when_all_required_fields_present()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Main St',
            'height' => '6ft',
            'weight' => '180lbs'
        ];

        $result = $this->openAIService->validateRequiredFields($data);
        
        $this->assertTrue($result);
    }

    public function test_validate_required_fields_returns_false_when_first_name_missing()
    {
        $data = [
            'first_name' => null,
            'last_name' => 'Doe',
            'address' => '123 Main St'
        ];

        $result = $this->openAIService->validateRequiredFields($data);
        
        $this->assertFalse($result);
    }

    public function test_validate_required_fields_returns_false_when_last_name_missing()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => null,
            'address' => '123 Main St'
        ];

        $result = $this->openAIService->validateRequiredFields($data);
        
        $this->assertFalse($result);
    }

    public function test_validate_required_fields_returns_false_when_address_missing()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => null
        ];

        $result = $this->openAIService->validateRequiredFields($data);
        
        $this->assertFalse($result);
    }

    public function test_validate_required_fields_returns_false_when_fields_are_empty_strings()
    {
        $data = [
            'first_name' => '',
            'last_name' => 'Doe',
            'address' => '123 Main St'
        ];

        $result = $this->openAIService->validateRequiredFields($data);
        
        $this->assertFalse($result);
    }
}