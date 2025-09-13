@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-violet-600 via-purple-600 to-indigo-700">
        <!-- Navigation Bar -->
        <nav class="bg-white/10 backdrop-blur-md border-b border-white/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <h1 class="text-xl font-bold text-white">Actor Portal</h1>
                    </div>
                    <a href="/actors" class="text-white/90 hover:text-white transition-colors duration-200 font-medium">
                        View Database →
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
            <div class="max-w-xl w-full">
                <!-- Hero Section -->
                <div class="text-center mb-10">
                    <div class="inline-flex p-4 rounded-full bg-white/10 backdrop-blur-sm mb-4">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-4xl font-extrabold text-white mb-2">
                        Actor Registration
                    </h2>
                    <p class="text-lg text-white/80">
                        Submit your profile and let AI extract your information
                    </p>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                    <actor-form></actor-form>
                </div>
            </div>
        </div>
    </div>
@endsection