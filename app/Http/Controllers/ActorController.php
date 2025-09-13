<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Services\OpenAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;
use Inertia\Inertia;

class ActorController extends Controller
{
    private OpenAIService $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function index()
    {
        $actors = Actor::latest()->get();
        return Inertia::render('Actors/Index', [
            'actors' => $actors
        ]);
    }

    public function create()
    {
        return Inertia::render('Actors/Create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', Rule::unique('actors', 'email')],
            'description' => ['required', 'string', Rule::unique('actors', 'description')]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $extractedData = $this->openAIService->extractActorInfo($request->description);
            
            if (!$this->openAIService->validateRequiredFields($extractedData)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please add first name, last name, and address to your description.'
                ], 422);
            }

            // Perform OpenAI analysis for gender and age
            $genderAnalysis = null;
            $ageAnalysis = null;

            if (!empty($extractedData['gender'])) {
                $genderAnalysis = $this->openAIService->analyzeGender(
                    $extractedData['gender'],
                    $request->description
                );
            }

            if (!empty($extractedData['age'])) {
                $ageAnalysis = $this->openAIService->analyzeAge(
                    $extractedData['age'],
                    $request->description
                );
            }

            $actor = Actor::create([
                'email' => $request->email,
                'description' => $request->description,
                'first_name' => $extractedData['first_name'],
                'last_name' => $extractedData['last_name'],
                'address' => $extractedData['address'],
                'height' => $extractedData['height'],
                'weight' => $extractedData['weight'],
                'gender' => $extractedData['gender'],
                'age' => $extractedData['age'],
                'gender_analysis' => $genderAnalysis,
                'age_analysis' => $ageAnalysis,
                'analysis_created_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'redirect' => route('actors.index')
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process your request. Please try again.'
            ], 500);
        }
    }

    public function show(Actor $actor)
    {
        return Inertia::render('Actors/Show', [
            'actor' => $actor
        ]);
    }

    public function getPromptValidation()
    {
        return response()->json([
            'message' => 'Please enter your first name and last name, and also provide your address.'
        ]);
    }
}