<script setup>
defineProps({
    title: String,
    value: Number
})
</script>

<template>
    <div class="text-center">
        <p class="text-sm text-gray-500">{{ title }}</p>
        <h2 class="mt-3 text-4xl font-bold text-green-800">{{ value }}</h2>
    </div>
</template>