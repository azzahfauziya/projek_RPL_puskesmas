<script setup>
defineProps({
  name: String,
  role: String,
  nip: String
})
</script>

<template>
  <div class="rounded-2xl bg-white text-center p-8 shadow-sm">
    <h1 class="text-3xl font-bold text-green-900">{{ name }}</h1>
    <p class="mt-2 text-gray-500">{{ role }}</p>
    <p class="text-sm text-gray-400">NIP {{ nip }}</p>
  </div>
</template>