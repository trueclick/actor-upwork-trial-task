<template>
    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="w-full max-w-2xl">
            <!-- Header Section -->
            <div class="text-center mb-8 animate-slideDown">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-fuchsia-500 rounded-full mb-4 shadow-lg hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">Actor Information Portal</h1>
                <p class="text-white/80 text-lg">Submit your actor profile with AI-powered processing</p>
            </div>

            <!-- Main Card -->
            <div class="glass-card rounded-3xl shadow-2xl overflow-hidden animate-fadeIn">
                <!-- Decorative Header -->
                <div class="h-2 bg-fuchsia-500"></div>
                
                <div class="p-8 md:p-10">
                    <!-- Success Message -->
                    <transition name="slide-fade">
                        <div v-if="successMessage" class="mb-6 p-4 bg-fuchsia-50 border border-fuchsia-200 rounded-xl shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-fuchsia-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-fuchsia-800 font-medium">{{ successMessage }}</p>
                            </div>
                        </div>
                    </transition>
                    
                    <!-- Error Message -->
                    <transition name="slide-fade">
                        <div v-if="errorMessage" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-red-800 font-medium">{{ errorMessage }}</p>
                            </div>
                        </div>
                    </transition>
                    
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <!-- Email Field -->
                        <div class="group">
                            <label for="email" class="block text-sm font-semibold text-fuchsia-700 mb-2">
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Email Address
                                </span>
                            </label>
                            <div class="relative">
                                <input
                                    v-model="form.email"
                                    type="email"
                                    id="email"
                                    placeholder="your.email@example.com"
                                    class="w-full px-4 py-3 bg-white border-2 border-fuchsia-200 rounded-xl focus:outline-none focus:border-fuchsia-500 focus:ring-4 focus:ring-fuchsia-100 transition-all duration-200 placeholder-gray-400 hover:border-fuchsia-300"
                                    :class="{'border-red-400 focus:border-red-500 focus:ring-red-100': errors.email}"
                                    required
                                />
                                <transition name="fade">
                                    <p v-if="errors.email" class="absolute -bottom-5 left-0 text-xs text-red-600 font-medium">
                                        {{ errors.email[0] }}
                                    </p>
                                </transition>
                            </div>
                        </div>
                        
                        <!-- Description Field -->
                        <div class="group mt-8">
                            <label for="description" class="block text-sm font-semibold text-fuchsia-700 mb-2">
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Actor Description
                                </span>
                            </label>
                            <div class="relative">
                                <textarea
                                    v-model="form.description"
                                    id="description"
                                    rows="6"
                                    placeholder="Describe yourself as an actor..."
                                    class="w-full px-4 py-3 bg-white border-2 border-fuchsia-200 rounded-xl focus:outline-none focus:border-fuchsia-500 focus:ring-4 focus:ring-fuchsia-100 transition-all duration-200 resize-none placeholder-gray-400 hover:border-fuchsia-300"
                                    :class="{'border-red-400 focus:border-red-500 focus:ring-red-100': errors.description}"
                                    required
                                ></textarea>
                                <transition name="fade">
                                    <p v-if="errors.description" class="absolute -bottom-5 left-0 text-xs text-red-600 font-medium">
                                        {{ errors.description[0] }}
                                    </p>
                                </transition>
                            </div>
                            <!-- Helper Text with Icon -->
                            <div class="mt-3 flex items-start">
                                <svg class="w-4 h-4 text-fuchsia-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm text-fuchsia-600 italic">{{ helperText }}</p>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button
                                type="submit"
                                :disabled="loading"
                                class="relative w-full py-4 px-6 text-white font-semibold rounded-xl bg-fuchsia-500 hover:bg-fuchsia-600 focus:outline-none focus:ring-4 focus:ring-fuchsia-200 disabled:opacity-50 disabled:cursor-not-allowed transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl"
                            >
                                <span v-if="!loading" class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Submit Information
                                </span>
                                <span v-else class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing with AI...
                                </span>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Footer Links -->
                    <div class="mt-8 pt-6 border-t border-fuchsia-200">
                        <div class="flex items-center justify-between">
                            <Link href="/actors" class="text-sm text-fuchsia-600 hover:text-fuchsia-700 font-medium flex items-center transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                View All Submissions
                            </Link>
                            <span class="text-xs text-fuchsia-500">Powered by OpenAI</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { router, Link } from '@inertiajs/vue3';

export default {
    name: 'ActorForm',
    setup() {
        const form = ref({
            email: '',
            description: ''
        });
        
        const errors = ref({});
        const loading = ref(false);
        const successMessage = ref('');
        const errorMessage = ref('');
        const helperText = ref('Please enter your first name and last name, and also provide your address.');
        
        const fetchHelperText = async () => {
            try {
                const response = await axios.get('/api/actors/prompt-validation');
                helperText.value = response.data.message;
            } catch (error) {
                console.error('Failed to fetch helper text:', error);
            }
        };
        
        const submitForm = async () => {
            loading.value = true;
            errors.value = {};
            successMessage.value = '';
            errorMessage.value = '';
            
            try {
                const response = await axios.post('/actors', form.value, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                if (response.data.success) {
                    window.location.href = response.data.redirect;
                }
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 422) {
                        if (error.response.data.errors) {
                            errors.value = error.response.data.errors;
                        } else if (error.response.data.message) {
                            errorMessage.value = error.response.data.message;
                        }
                    } else {
                        errorMessage.value = error.response.data.message || 'An error occurred. Please try again.';
                    }
                } else {
                    errorMessage.value = 'Network error. Please check your connection.';
                }
            } finally {
                loading.value = false;
            }
        };
        
        onMounted(() => {
            fetchHelperText();
        });
        
        return {
            form,
            errors,
            loading,
            successMessage,
            errorMessage,
            helperText,
            submitForm
        };
    }
};
</script>

<style scoped>
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slide-fade-enter {
    from {
        transform: translateY(-10px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes fade-enter {
    from { opacity: 0; }
    to { opacity: 1; }
}

.animate-slideDown {
    animation: slideDown 0.8s ease-out;
}

.animate-fadeIn {
    animation: fadeIn 1s ease-out;
}

.slide-fade-enter-active {
    animation: slide-fade-enter 0.3s ease-out;
}

.slide-fade-leave-active {
    animation: slide-fade-enter 0.3s ease-out reverse;
}

.fade-enter-active {
    animation: fade-enter 0.2s ease-out;
}

.fade-leave-active {
    animation: fade-enter 0.2s ease-out reverse;
}

.glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
}

.hover\:scale-110:hover {
    transform: scale(1.1);
}
</style>