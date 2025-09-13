<template>
    <div class="min-h-screen py-6 px-4 relative">
        <!-- Subtle Background -->
        <div class="absolute inset-0 -z-10">
            <div class="absolute inset-0 bg-fuchsia-50"></div>
            <!-- Subtle Floating Elements -->
            <div class="floating-elements">
                <div class="float-circle" style="top: 10%; left: 5%; animation-delay: 0s;"></div>
                <div class="float-circle" style="top: 60%; left: 10%; animation-delay: 2s;"></div>
                <div class="float-circle" style="top: 30%; left: 85%; animation-delay: 4s;"></div>
                <div class="float-circle" style="top: 80%; left: 80%; animation-delay: 6s;"></div>
                <div class="float-circle" style="top: 40%; left: 50%; animation-delay: 8s;"></div>
            </div>
        </div>

        <div class="max-w-full mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-fuchsia-600 rounded-lg mb-3 shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-fuchsia-900 mb-2">Actor Database</h1>
                <p class="text-fuchsia-700 text-sm">Complete profiles and information</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-lg shadow-md border border-fuchsia-100 overflow-hidden">
                <!-- Card Header -->
                <div class="bg-fuchsia-600 px-4 py-3 border-b">
                    <div class="flex justify-between items-center">
                        <div class="text-white">
                            <h2 class="text-lg font-semibold">Actor Profiles</h2>
                            <p class="text-fuchsia-100 text-sm">{{ actors.length }} registered</p>
                        </div>
                        <Link
                            href="/"
                            class="inline-flex items-center px-3 py-2 bg-white text-fuchsia-600 font-medium rounded-md hover:bg-fuchsia-50 transition-colors duration-200 text-sm shadow-sm"
                        >
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Actor
                        </Link>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-if="actors.length === 0" class="p-12 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-fuchsia-100 rounded-lg mb-4">
                        <svg class="w-8 h-8 text-fuchsia-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-fuchsia-800 mb-2">No Actors Found</h3>
                    <p class="text-fuchsia-600 mb-6">Start by adding your first actor profile</p>
                    <Link
                        href="/"
                        class="inline-flex items-center px-4 py-2 bg-fuchsia-600 text-white font-medium rounded-md hover:bg-fuchsia-700 transition-colors duration-200"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add First Actor
                    </Link>
                </div>

                <!-- Data Table -->
                <div v-else class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-fuchsia-50">
                            <tr>
                                <th class="px-3 py-3 text-left">
                                    <span class="text-xs font-medium text-fuchsia-700 uppercase tracking-wide">Name</span>
                                </th>
                                <th class="px-3 py-3 text-left">
                                    <span class="text-xs font-medium text-fuchsia-700 uppercase tracking-wide">Email</span>
                                </th>
                                <th class="px-3 py-3 text-left">
                                    <span class="text-xs font-medium text-fuchsia-700 uppercase tracking-wide">Gender</span>
                                </th>
                                <th class="px-3 py-3 text-left">
                                    <span class="text-xs font-medium text-fuchsia-700 uppercase tracking-wide">Age</span>
                                </th>
                                <th class="px-3 py-3 text-left">
                                    <span class="text-xs font-medium text-fuchsia-700 uppercase tracking-wide">Address</span>
                                </th>
                                <th class="px-3 py-3 text-left">
                                    <span class="text-xs font-medium text-fuchsia-700 uppercase tracking-wide">Height</span>
                                </th>
                                <th class="px-3 py-3 text-left">
                                    <span class="text-xs font-medium text-fuchsia-700 uppercase tracking-wide">Weight</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-fuchsia-100">
                            <tr v-for="(actor, index) in actors"
                                :key="actor.id"
                                class="hover:bg-fuchsia-25 transition-colors duration-150 cursor-pointer"
                                :style="`animation-delay: ${index * 100}ms`"
                                @click="viewActor(actor.id)">

                                <!-- Name Column -->
                                <td class="px-3 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 bg-fuchsia-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                            {{ getInitials(actor.first_name, actor.last_name) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ actor.first_name }} {{ actor.last_name }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Email Column -->
                                <td class="px-3 py-4">
                                    <span class="text-sm text-gray-700">{{ actor.email }}</span>
                                </td>

                                <!-- Gender Column -->
                                <td class="px-3 py-4">
                                    <div v-if="actor.gender" class="inline-flex items-center px-2 py-1 rounded text-xs font-medium"
                                         :class="getGenderClass(actor.gender)">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ actor.gender }}
                                    </div>
                                    <span v-else class="text-xs text-gray-400 italic">Not specified</span>
                                </td>

                                <!-- Age Column -->
                                <td class="px-3 py-4">
                                    <div v-if="actor.age" class="flex items-center text-sm text-gray-700">
                                        <svg class="w-4 h-4 text-fuchsia-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ actor.age }}</span>
                                    </div>
                                    <span v-else class="text-xs text-gray-400 italic">Not specified</span>
                                </td>

                                <!-- Address Column -->
                                <td class="px-3 py-4">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-fuchsia-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700">{{ actor.address || 'Not specified' }}</span>
                                    </div>
                                </td>

                                <!-- Height Column -->
                                <td class="px-3 py-4">
                                    <div v-if="actor.height" class="flex items-center text-sm text-gray-700">
                                        <svg class="w-4 h-4 text-fuchsia-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                        <span>{{ actor.height }}</span>
                                    </div>
                                    <span v-else class="text-xs text-gray-400 italic">Not specified</span>
                                </td>

                                <!-- Weight Column -->
                                <td class="px-3 py-4">
                                    <div v-if="actor.weight" class="flex items-center text-sm text-gray-700">
                                        <svg class="w-4 h-4 text-fuchsia-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l-3-1m3 1l3-1"></path>
                                        </svg>
                                        <span>{{ actor.weight }}</span>
                                    </div>
                                    <span v-else class="text-xs text-gray-400 italic">Not specified</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Stats -->
                <div v-if="actors.length > 0" class="bg-fuchsia-25 px-4 py-3 border-t border-fuchsia-100">
                    <div class="flex justify-between items-center text-sm">
                        <div class="flex items-center text-fuchsia-600">
                            <div class="w-2 h-2 bg-fuchsia-500 rounded-full mr-2"></div>
                            <span>{{ actors.length }} total profiles</span>
                        </div>
                        <div class="text-fuchsia-500 text-xs">
                            Last updated: {{ new Date().toLocaleTimeString() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    actors: {
        type: Array,
        required: true,
        default: () => []
    }
});

const getInitials = (firstName, lastName) => {
    return (firstName?.charAt(0) || '') + (lastName?.charAt(0) || '');
};

const getGenderClass = (gender) => {
    const lowerGender = gender?.toLowerCase();
    if (lowerGender === 'male') {
        return 'bg-blue-100 text-blue-800';
    } else if (lowerGender === 'female') {
        return 'bg-pink-100 text-pink-800';
    }
    return 'bg-gray-100 text-gray-700';
};

const viewActor = (actorId) => {
    window.location.href = `/actors/${actorId}`;
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
    width: 80px;
    height: 80px;
    background: rgba(236, 72, 153, 0.08);
    border-radius: 50%;
    animation: gentle-float 20s infinite ease-in-out;
}

@keyframes gentle-float {
    0%, 100% {
        transform: translateY(0px) translateX(0px);
        opacity: 0.3;
    }
    50% {
        transform: translateY(-30px) translateX(20px);
        opacity: 0.1;
    }
}

/* Subtle hover effects */
.bg-fuchsia-25 {
    background-color: rgba(236, 72, 153, 0.02);
}

/* Table row stagger animation */
tbody tr {
    opacity: 0;
    animation: fade-in-up 0.5s ease-out forwards;
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hover animations */
.hover\:bg-fuchsia-25:hover {
    background-color: rgba(236, 72, 153, 0.02);
}
</style>