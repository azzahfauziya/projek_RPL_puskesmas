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

    const statusPerawatan = computed(() => {
        return props.pendaftaran.rekam_medis
            ? 'Selesai'
            : 'Menunggu'
    })

    const warnaStatus = computed(() => {
        return props.pendaftaran.rekam_medis
            ? 'bg-green-600'
            : 'bg-red-500'
    })

    const isDokterOrPerawat = computed(() =>
        ['dokter', 'perawat'].includes(role.value)
    )
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" @close="sidebarOpen = false" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8">
                <div class="p-4 sm:p-6 md:p-8 bg-white rounded-lg shadow-md border border-gray-300">
                    <!-- Header -->
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-green-900">
                            Input pendaftaran
                        </h1>

                        <div class="flex items-center gap-3 border-2 border-green-900 rounded-2xl px-4 sm:px-6 py-2 sm:py-3 bg-white self-start sm:self-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor" class="size-6 sm:size-8 text-emerald-800">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 6h15A1.5 1.5 0 0 1 21 7.5v12A1.5 1.5 0 0 1 19.5 21h-15A1.5 1.5 0 0 1 3 19.5v-12A1.5 1.5 0 0 1 4.5 6Z" />
                            </svg>
                            <span class="font-semibold text-base sm:text-lg">
                                {{ formatTanggal(pendaftaran.tanggal_kunjungan) }}
                            </span>
                        </div>
                    </div>

                    <div class="gap-6 sm:gap-8 items-start">
                        <!-- Kolom Kiri -->
                        <div>
                            <div class="flex mb-4 sm:mb-6">
                                <span class="font-bold w-36 sm:w-40 shrink-0 text-sm sm:text-base">No Registrasi</span>
                                <span class="mr-4 shrink-0">:</span>
                                <span class="text-sm sm:text-base">{{ pendaftaran.no_registrasi }}</span>
                            </div>

                            <div class="flex mb-4 sm:mb-6">
                                <span class="font-bold w-36 sm:w-40 shrink-0 text-sm sm:text-base">No RM</span>
                                <span class="mr-4 shrink-0">:</span>
                                <span class="text-sm sm:text-base">{{ pendaftaran.no_rm }}</span>
                            </div>

                            <div class="flex mb-4 sm:mb-6">
                                <span class="font-bold w-36 sm:w-40 shrink-0 text-sm sm:text-base">Nama Pasien</span>
                                <span class="mr-4 shrink-0">:</span>
                                <span class="text-sm sm:text-base">{{ pendaftaran.pasien.nama }}</span>
                            </div>

                            <div class="flex mb-4 sm:mb-6">
                                <span class="font-bold w-36 sm:w-40 shrink-0 text-sm sm:text-base">Jenis kelamin</span>
                                <span class="mr-4 shrink-0">:</span>
                                <span class="text-sm sm:text-base">{{ pendaftaran.pasien.jenis_kelamin }}</span>
                            </div>
                        </div>

                        <div>
                            <div class="flex mb-4 sm:mb-6">
                                <span class="font-bold w-36 sm:w-40 shrink-0 text-sm sm:text-base">Tanggal Lahir</span>
                                <span class="mr-4 shrink-0">:</span>
                                <span class="text-sm sm:text-base">{{ pendaftaran.pasien.tanggal_lahir }}</span>
                            </div>

                            <div class="flex mb-4 sm:mb-6">
                                <span class="font-bold w-36 sm:w-40 shrink-0 text-sm sm:text-base">Keluhan Awal</span>
                                <span class="mr-4 shrink-0">:</span>
                                <span class="text-sm sm:text-base">{{ pendaftaran.keluhan_awal }}</span>
                            </div>

                            <div class="flex mb-4 sm:mb-6">
                                <span class="font-bold w-36 sm:w-40 shrink-0 text-sm sm:text-base">Status Perawatan</span>
                                <span class="mr-4 shrink-0">:</span>
                                <div class="flex items-center justify-center text-white rounded-xl px-3 sm:px-4 py-1 sm:py-2 text-sm sm:text-base"
                                    :class="warnaStatus">
                                    {{ statusPerawatan }}
                                </div>
                            </div>
                        </div>

                        <!-- Tombol aksi -->
                        <div>
                            <div v-if="isDokterOrPerawat" class="flex flex-wrap gap-3 justify-end">
                                <Link :href="route('form-tindakan', pendaftaran.no_registrasi)"
                                    class="flex-1 sm:flex-none sm:w-48 md:w-64 h-12 sm:h-16 bg-green-900 hover:bg-green-800 text-white font-semibold text-base sm:text-xl rounded-2xl transition flex items-center justify-center text-center px-3">
                                    Input Tindakan
                                </Link>
                                <Link :href="route('form-resep', pendaftaran.no_registrasi)"
                                    class="flex-1 sm:flex-none sm:w-48 md:w-64 h-12 sm:h-16 bg-green-900 hover:bg-green-800 text-white font-semibold text-base sm:text-xl rounded-2xl transition flex items-center justify-center text-center px-3">
                                    Input Resep Obat
                                </Link>
                                <Link :href="route('form-diagnosa', pendaftaran.no_registrasi)"
                                    class="flex-1 sm:flex-none sm:w-48 md:w-64 h-12 sm:h-16 bg-green-900 hover:bg-green-800 text-white font-semibold text-base sm:text-xl rounded-2xl transition flex items-center justify-center text-center px-3">
                                    Input Diagnosa
                                </Link>
                            </div>
                            <div v-if="role === 'administrasi' && pendaftaran.jenis_pendaftaran === 'darurat'" class="flex gap-3 justify-end">
                                <Link :href="route('pendaftaran.edit', pendaftaran.no_registrasi)"
                                    class="flex-1 sm:flex-none sm:w-48 md:w-64 h-12 sm:h-16 bg-green-900 hover:bg-green-800 text-white font-semibold text-base sm:text-xl rounded-2xl transition flex items-center justify-center text-center px-3">
                                    Edit Data
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
