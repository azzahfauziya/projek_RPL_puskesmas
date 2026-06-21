<script setup>
import { ref, computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    pendaftaran: Object
})
const sidebarOpen = ref(false)
const page = usePage()
const role = computed(() => page.props.auth?.user?.role)

const formatTanggal = (tanggal) => {
    return new Date(tanggal).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    })
}
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-8">
                <div class="p-8 bg-white rounded-lg shadow-md border border-gray-300">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-4xl font-bold text-green-900">
                            Input pendaftaran
                        </h1>

                        <div class="flex items-center gap-3 border-2 border-green-900 rounded-2xl px-6 py-3 bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor" class="size-8 text-emerald-800">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 6h15A1.5 1.5 0 0 1 21 7.5v12A1.5 1.5 0 0 1 19.5 21h-15A1.5 1.5 0 0 1 3 19.5v-12A1.5 1.5 0 0 1 4.5 6Z" />

                            </svg>

                            <span class="font-semibold text-lg">
                                {{ formatTanggal(pendaftaran.tanggal_kunjungan) }}
                            </span>
                        </div>
                    </div>

                    <div class="gap-8 items-start">
                        <!-- Kolom Kiri -->
                        <div>
                            <div class="flex mb-6">
                                <span class="font-bold w-40">No Registrasi</span>
                                <span class="mr-4">:</span>
                                <span>{{ pendaftaran.no_registrasi }}</span>
                            </div>

                            <div class="flex mb-6">
                                <span class="font-bold w-40 shrink-0">No RM</span>
                                <span class="mr-4 shrink-0">:</span>
                                <span>{{ pendaftaran.no_rm }}</span>
                            </div>

                            <div class="flex mb-6">
                                <span class="font-bold w-40 shrink-0">Nama Pasien</span>
                                <span class="mr-4 shrink-0">:</span>
                                <span>{{ pendaftaran.pasien.nama }}</span>
                            </div>

                            <div class="flex mb-6">
                                <span class="font-bold w-40 shrink-0">Jenis kelamin</span>
                                <span class="mr-4 shrink-0">:</span>
                                <span>{{ pendaftaran.pasien.jenis_kelamin }}</span>
                            </div>
                        </div>

                        <div>
                            <div class="flex mb-6">
                                <span class="font-bold w-40">Tanggal Lahir</span>
                                <span class="mr-4">:</span>
                                <span>{{ pendaftaran.pasien.tanggal_lahir }}</span>
                            </div>

                            <div class="flex mb-6">
                                <span class="font-bold w-40">Keluhan Awal</span>
                                <span class="mr-4">:</span>
                                <span>{{ pendaftaran.keluhan_awal }}</span>
                            </div>

                            <div class="flex mb-6">
                                <span class="font-bold w-40">Status Perawatan</span>
                                <span class="mr-4">:</span>
                                <div class="flex items-center justify-center text-white rounded-xl px-2 py-2 border border-gray-500"
                                    style="background-color:#E3483D;">
                                    Menunggu
                                </div>
                            </div>
                        </div>

                        <!-- hanya muncul untuk dokter -->
                        <div v-if="role === 'dokter'" class="flex gap-3 justify-end">
                            <Link :href="route('form-tindakan', pendaftaran.no_registrasi)"
                                class="w-64 h-16 bg-green-900 hover:bg-green-800 text-white font-semibold text-xl rounded-2xl transition flex items-center justify-center">
                                Input Tindakan
                            </Link>
                            <Link :href="route('form-resep', pendaftaran.no_registrasi)"
                                class="w-64 h-16 bg-green-900 hover:bg-green-800 text-white font-semibold text-xl rounded-2xl transition flex items-center justify-center">
                                Input Resep Obat
                            </Link>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

</template>
