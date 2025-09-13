<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class OpenAIService
{
    private string $apiKey;
    private string $orgId;

    public function __construct()
    {
        $this->apiKey = config('services.openai.secret');
        $this->orgId = config('services.openai.org_id');
    }

    public function extractActorInfo(string $description): array
    {
        $prompt = "Extract actor information from the description below. Return ONLY a JSON object with these exact keys:

- first_name: The person's first name
- last_name: The person's last name
- address: Full address or location (city, state, country, etc.)
- height: Height measurement (keep original format like '5'6\"', '170cm', '5 feet 6 inches', etc.)
- weight: Weight measurement (keep original format like '150lbs', '68kg', '150 pounds', etc.)
- gender: Gender (male, female, etc.)
- age: Age in years (look for phrases like 'I am 25', 'age 30', '35 years old', 'born in 1990', etc. Extract only the number)

CRITICAL INSTRUCTIONS:
1. Look carefully for ALL information throughout the ENTIRE description
2. Age can be mentioned as: 'I am X years old', 'X years old', 'age X', 'aged X', 'I'm X', 'born in YYYY', or just a number followed by 'years'
3. Gender can be mentioned as: 'I am male/female', 'man/woman', 'guy/girl', 'he/she', 'his/her', 'actor/actress'
4. Scan every sentence for this information
5. If information is missing, use null

Description: " . $description;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'OpenAI-Organization' => $this->orgId,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful assistant that extracts structured information from text. Always respond with valid JSON only.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.3,
                'max_tokens' => 500,
                'response_format' => ['type' => 'json_object']
            ]);

            if (!$response->successful()) {
                throw new Exception('OpenAI API request failed: ' . $response->body());
            }

            $data = $response->json();
            $content = $data['choices'][0]['message']['content'] ?? '{}';
            $extracted = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Failed to parse OpenAI response as JSON');
            }

            return [
                'first_name' => $extracted['first_name'] ?? null,
                'last_name' => $extracted['last_name'] ?? null,
                'address' => $extracted['address'] ?? null,
                'height' => $extracted['height'] ?? null,
                'weight' => $extracted['weight'] ?? null,
                'gender' => $extracted['gender'] ?? null,
                'age' => $extracted['age'] ?? null,
            ];

        } catch (Exception $e) {
            throw new Exception('Failed to extract actor information: ' . $e->getMessage());
        }
    }

    public function validateRequiredFields(array $extractedData): bool
    {
        return !empty($extractedData['first_name']) &&
               !empty($extractedData['last_name']) &&
               !empty($extractedData['address']);
    }

    public function analyzeGender(?string $gender, string $description): ?string
    {
        if (empty($gender) || trim($gender) === '' || $gender === null) {
            return null;
        }

        $prompt = "Analyze the following gender information in the context of the actor's description. Provide insights about how this gender might influence their acting roles, character types they could portray, and any relevant industry considerations. Be professional and objective.

Gender: {$gender}
Actor Description: {$description}

Provide a brief analysis (2-3 sentences) focusing on acting opportunities and career aspects.";

        return $this->performAnalysis($prompt);
    }

    public function analyzeAge(?string $age, string $description): ?string
    {
        if (empty($age) || trim($age) === '' || $age === null) {
            return null;
        }

        $prompt = "Analyze the following age information in the context of the actor's description. Provide insights about age-appropriate roles, career stage considerations, and how this age range affects casting opportunities. Be professional and constructive.

Age: {$age} years old
Actor Description: {$description}

Provide a brief analysis (2-3 sentences) focusing on career opportunities and age-related casting considerations.";

        return $this->performAnalysis($prompt);
    }

    private function performAnalysis(string $prompt): ?string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'OpenAI-Organization' => $this->orgId,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a professional casting director and industry analyst who provides constructive insights about actors and their career opportunities.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 200
            ]);

            if (!$response->successful()) {
                return null;
            }

            $data = $response->json();
            return $data['choices'][0]['message']['content'] ?? null;

        } catch (Exception $e) {
            return null;
        }
    }
}