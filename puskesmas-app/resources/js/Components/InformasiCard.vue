<script setup>
import StatsCard from '@/Components/StatsCard.vue'
</script>

<template>
    <div class="rounded-2xl bg-white p-6 shadow-sm">
        <StatsCard title="Pengunjung Hari Ini" :value="15" />

        <h2 class="mb-4 mt-8 text-xl font-bold text-green-900">Informasi</h2>

        <div class="space-y-3">
            <div class="flex items-center justify-between border-b pb-3">
                <span>Daftar Staff</span>
                <button class="rounded-lg bg-green-800 px-4 py-2 text-white">Lihat</button>
            </div>
        </div>
    </div>
</template>