<template>
    <div class="min-h-screen py-6 px-4 relative bg-fuchsia-50">
        <!-- Subtle Background -->
        <div class="absolute inset-0 -z-10">
            <div class="floating-elements">
                <div class="float-circle" style="top: 15%; left: 10%; animation-delay: 0s;"></div>
                <div class="float-circle" style="top: 70%; left: 15%; animation-delay: 3s;"></div>
                <div class="float-circle" style="top: 40%; left: 80%; animation-delay: 6s;"></div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <Link href="/actors" class="inline-flex items-center text-fuchsia-600 hover:text-fuchsia-700 mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Actors
                </Link>
                <h1 class="text-3xl font-bold text-fuchsia-900">{{ actor.first_name }} {{ actor.last_name }}</h1>
                <p class="text-fuchsia-700 mt-1">Actor Profile & AI Analysis</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-lg shadow-md border border-fuchsia-100 p-6">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 bg-fuchsia-600 rounded-full flex items-center justify-center text-white text-lg font-bold mr-4">
                            {{ getInitials(actor.first_name, actor.last_name) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Basic Information</h2>
                            <p class="text-gray-600 text-sm">Personal details and contact</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-fuchsia-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            <span class="text-gray-700">{{ actor.email }}</span>
                        </div>

                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-fuchsia-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-700">{{ actor.address }}</span>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div v-if="actor.gender" class="flex items-center">
                                <svg class="w-5 h-5 text-fuchsia-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">{{ actor.gender }}</span>
                            </div>

                            <div v-if="actor.age" class="flex items-center">
                                <svg class="w-5 h-5 text-fuchsia-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-700">{{ actor.age }} years old</span>
                            </div>

                            <div v-if="actor.height" class="flex items-center">
                                <svg class="w-5 h-5 text-fuchsia-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                                <span class="text-gray-700">{{ actor.height }}</span>
                            </div>

                            <div v-if="actor.weight" class="flex items-center">
                                <svg class="w-5 h-5 text-fuchsia-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l-3-1m3 1l3-1"></path>
                                </svg>
                                <span class="text-gray-700">{{ actor.weight }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="bg-white rounded-lg shadow-md border border-fuchsia-100 p-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-fuchsia-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Actor Description</h2>
                            <p class="text-gray-600 text-sm">Original submission</p>
                        </div>
                    </div>
                    <div class="bg-fuchsia-25 rounded-lg p-4">
                        <p class="text-gray-800 leading-relaxed">{{ actor.description }}</p>
                    </div>
                </div>
            </div>

            <!-- AI Analysis Section -->
            <div v-if="actor.gender_analysis || actor.age_analysis" class="mt-6">
                <h2 class="text-2xl font-bold text-fuchsia-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    AI Analysis & Insights
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Gender Analysis -->
                    <div v-if="actor.gender_analysis" class="bg-white rounded-lg shadow-md border border-fuchsia-100 p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Gender Analysis</h3>
                                <p class="text-gray-600 text-sm">Industry insights based on gender</p>
                            </div>
                        </div>
                        <div class="bg-blue-25 rounded-lg p-4">
                            <p class="text-gray-800 leading-relaxed">{{ actor.gender_analysis }}</p>
                        </div>
                    </div>

                    <!-- Age Analysis -->
                    <div v-if="actor.age_analysis" class="bg-white rounded-lg shadow-md border border-fuchsia-100 p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Age Analysis</h3>
                                <p class="text-gray-600 text-sm">Career insights based on age</p>
                            </div>
                        </div>
                        <div class="bg-green-25 rounded-lg p-4">
                            <p class="text-gray-800 leading-relaxed">{{ actor.age_analysis }}</p>
                        </div>
                    </div>
                </div>

                <!-- Analysis Timestamp -->
                <div v-if="actor.analysis_created_at" class="mt-4 text-center">
                    <p class="text-sm text-gray-500">
                        Analysis generated on {{ formatDate(actor.analysis_created_at) }}
                    </p>
                </div>
            </div>

            <!-- No Analysis Message -->
            <div v-else class="mt-6 bg-gray-50 rounded-lg p-8 text-center">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">No AI Analysis Available</h3>
                <p class="text-gray-500">Analysis is generated when gender or age information is provided during actor submission.</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    actor: {
        type: Object,
        required: true
    }
});

const getInitials = (firstName, lastName) => {
    return (firstName?.charAt(0) || '') + (lastName?.charAt(0) || '');
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};
</script>

<style scoped>
/* Subtle Background Elements */
.floating-elements {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.float-circle {
    position: absolute;
    width: 100px;
    height: 100px;
    background: rgba(236, 72, 153, 0.05);
    border-radius: 50%;
    animation: gentle-float 25s infinite ease-in-out;
}

@keyframes gentle-float {
    0%, 100% {
        transform: translateY(0px) translateX(0px);
        opacity: 0.2;
    }
    50% {
        transform: translateY(-40px) translateX(30px);
        opacity: 0.1;
    }
}

/* Custom background colors */
.bg-fuchsia-25 {
    background-color: rgba(236, 72, 153, 0.03);
}

.bg-blue-25 {
    background-color: rgba(59, 130, 246, 0.03);
}

.bg-green-25 {
    background-color: rgba(34, 197, 94, 0.03);
}
</style>