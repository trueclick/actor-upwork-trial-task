<template>
    <div class="min-h-screen bg-fuchsia-900 relative overflow-hidden">
        <!-- Animated Background with Particle Effects -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -inset-10 bg-fuchsia-900">
                <div class="absolute top-0 -left-4 w-72 h-72 bg-pink-700 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
                <div class="absolute top-0 -right-4 w-72 h-72 bg-rose-600 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-600 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
            </div>
            <!-- Floating Particles -->
            <div class="particle-container">
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
                <div class="particle particle-4"></div>
                <div class="particle particle-5"></div>
                <div class="particle particle-6"></div>
                <div class="particle particle-7"></div>
                <div class="particle particle-8"></div>
                <div class="particle particle-9"></div>
                <div class="particle particle-10"></div>
            </div>
        </div>
        
        <!-- Navigation Bar -->
        <nav class="bg-fuchsia-800/50 backdrop-blur-md border-b border-fuchsia-700/50 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center animate-slideRight">
                        <svg class="w-8 h-8 text-pink-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <h1 class="text-xl font-bold text-white">Actor Portal</h1>
                    </div>
                    <Link href="/actors" class="text-pink-100 hover:text-white transition-colors duration-200 font-medium hover:scale-105 transform">
                        View Database →
                    </Link>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-xl w-full">
                <!-- Hero Section -->
                <div class="text-center mb-10 animate-slideDown">
                    <div class="inline-flex p-4 rounded-full bg-fuchsia-800/30 backdrop-blur-sm mb-4 hover:rotate-12 transition-transform duration-500">
                        <svg class="w-12 h-12 text-pink-300 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-4xl font-extrabold text-white mb-2">
                        Actor Registration
                    </h2>
                    <p class="text-lg text-pink-200">
                        Submit your profile and let AI extract your information
                    </p>
                </div>

                <!-- Form Card -->
                <div class="glass-card-dark rounded-2xl shadow-2xl overflow-hidden animate-fadeIn">
                    <ActorForm />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import ActorForm from '@/Components/ActorForm.vue';

defineProps({
    errors: Object,
});

// Removed particles configuration due to component error
// Will use pure CSS animations instead
/*
const particlesOptions = {
    background: {
        color: {
            value: "transparent",
        },
    },
    fpsLimit: 60,
    interactivity: {
        events: {
            onClick: {
                enable: true,
                mode: "push",
            },
            onHover: {
                enable: true,
                mode: "repulse",
            },
            resize: true,
        },
        modes: {
            push: {
                quantity: 3,
            },
            repulse: {
                distance: 150,
                duration: 0.4,
            },
        },
    },
    particles: {
        color: {
            value: ["#34d399", "#6ee7b7", "#a7f3d0"],
        },
        links: {
            color: "#34d399",
            distance: 150,
            enable: true,
            opacity: 0.3,
            width: 1,
        },
        move: {
            direction: "none",
            enable: true,
            outModes: {
                default: "bounce",
            },
            random: true,
            speed: 2,
            straight: false,
        },
        number: {
            density: {
                enable: true,
                area: 800,
            },
            value: 50,
        },
        opacity: {
            value: 0.5,
            animation: {
                enable: true,
                speed: 1,
                minimumValue: 0.1,
                sync: false
            }
        },
        shape: {
            type: "circle",
        },
        size: {
            value: { min: 1, max: 4 },
            animation: {
                enable: true,
                speed: 3,
                minimumValue: 0.5,
                sync: false
            }
        },
    },
    detectRetina: true,
};
*/
</script>

<style scoped>
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideRight {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes blob {
    0% {
        transform: translate(0px, 0px) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
    100% {
        transform: translate(0px, 0px) scale(1);
    }
}

.animate-slideDown {
    animation: slideDown 0.8s ease-out;
}

.animate-slideRight {
    animation: slideRight 0.8s ease-out;
}

.animate-fadeIn {
    animation: fadeIn 1s ease-out;
}

.glass-card-dark {
    background: rgba(236, 72, 153, 0.05);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(244, 114, 182, 0.2);
}

.hover\:rotate-12:hover {
    transform: rotate(12deg);
}

.hover\:scale-105:hover {
    transform: scale(1.05);
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

/* Particle Effects */
.particle-container {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: linear-gradient(45deg, #ec4899, #f472b6);
    border-radius: 50%;
    opacity: 0.6;
    animation: float-up 15s infinite;
}

@keyframes float-up {
    0% {
        transform: translateY(100vh) translateX(0);
        opacity: 0;
    }
    10% {
        opacity: 0.6;
    }
    90% {
        opacity: 0.6;
    }
    100% {
        transform: translateY(-100vh) translateX(100px);
        opacity: 0;
    }
}

.particle-1 { left: 10%; animation-delay: 0s; animation-duration: 12s; }
.particle-2 { left: 20%; animation-delay: 2s; animation-duration: 14s; }
.particle-3 { left: 30%; animation-delay: 4s; animation-duration: 16s; }
.particle-4 { left: 40%; animation-delay: 6s; animation-duration: 13s; }
.particle-5 { left: 50%; animation-delay: 8s; animation-duration: 15s; }
.particle-6 { left: 60%; animation-delay: 1s; animation-duration: 17s; }
.particle-7 { left: 70%; animation-delay: 3s; animation-duration: 14s; }
.particle-8 { left: 80%; animation-delay: 5s; animation-duration: 12s; }
.particle-9 { left: 90%; animation-delay: 7s; animation-duration: 16s; }
.particle-10 { left: 5%; animation-delay: 9s; animation-duration: 13s; }
</style>