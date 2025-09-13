<template>
    <div class="min-h-screen bg-fuchsia-900">
        <ActorsTable :actors="actors" />
    </div>
</template>

<script setup>
import ActorsTable from '@/Components/ActorsTable.vue';

defineProps({
    actors: {
        type: Array,
        required: true,
        default: () => []
    }
});
</script>