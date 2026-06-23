<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    pasien: Object,
    kunjungan: { type: Array, default: () => [] },
})

const sidebarOpen = ref(false)
const currentPage = ref(1)
const filterTanggal = ref('')
const dateInput = ref(null)

function openDatePicker() {
    dateInput.value.showPicker()
}

const filtered = computed(() => {
    if (!filterTanggal.value) return props.kunjungan
    return props.kunjungan.filter(k => k.tanggal_kunjungan === filterTanggal.value)
})

const totalPages = computed(() => filtered.value.length)

const current = computed(() => filtered.value[currentPage.value - 1] ?? null)

const formatTanggal = (tgl) => {
    return new Date(tgl).toLocaleDateString('id-ID', {
        weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
    })
}
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-4 md:p-8">

                <!-- Filter tanggal -->
                <div class="flex justify-end mb-4 gap-2 items-center">
                    <span v-if="filterTanggal" class="text-xs text-slate-600">{{ filterTanggal }}</span>
                    <button v-if="filterTanggal" @click="filterTanggal = ''; currentPage = 1"
                        class="text-slate-400 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <button @click="openDatePicker" class="text-slate-500 hover:text-emerald-700 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </button>
                    <input ref="dateInput" v-model="filterTanggal" @change="currentPage = 1" type="date"
                        class="w-1 h-1 opacity-0 absolute" />
                </div>

                <div v-if="!current" class="text-center text-slate-400 py-16">Tidak ada data kunjungan</div>

                <template v-else>
                    <!-- Keterangan Pasien -->
                    <div class="bg-green-100 rounded-lg p-4 md:p-8 shadow">
                        <h1 class="text-2xl md:text-3xl mb-6 md:mb-8 font-extrabold text-emerald-800">Keterangan Pasien
                        </h1>
                        <div class="grid grid-cols-2 xl:grid-cols-3 gap-4 md:gap-8">
                            <div>
                                <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                                    <span class="font-bold md:w-40 shrink-0">No RM</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pasien.no_rm }}</span>
                                </div>
                                <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                                    <span class="font-bold md:w-40 shrink-0">Nama Pasien</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pasien.nama }}</span>
                                </div>
                                <div class="flex flex-col md:flex-row">
                                    <span class="font-bold md:w-40 shrink-0">Tanggal Lahir</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pasien.tanggal_lahir }}</span>
                                </div>
                            </div>
                            <div>
                                <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                                    <span class="font-bold md:w-40 shrink-0">Jenis Kelamin</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pasien.jenis_kelamin }}</span>
                                </div>
                                <div class="flex flex-col md:flex-row mb-4 md:mb-6">
                                    <span class="font-bold md:w-40 shrink-0">TB / BB</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ current.tinggi_badan ?? '-' }} cm / {{
                                        current.berat_badan ?? '-' }} kg</span>
                                </div>
                                <div class="flex flex-col md:flex-row">
                                    <span class="font-bold md:w-40 shrink-0">Kelas BPJS</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pasien.kelas_bpjs }}</span>
                                </div>
                            </div>
                            <div class="col-span-2 xl:col-span-1">
                                <div class="flex flex-col md:flex-row">
                                    <span class="font-bold md:w-40 shrink-0">Alamat</span>
                                    <span class="hidden md:inline mr-4">:</span>
                                    <span class="break-words min-w-0">{{ pasien.alamat }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Kunjungan -->
                    <div class="bg-white border-2 rounded-2xl p-4 md:p-8 mt-4">
                        <div class="flex flex-col md:grid md:grid-cols-3 gap-4 md:gap-8 items-start">
                            <div class="order-2 md:order-1">
                                <div class="flex flex-col mb-4 md:mb-6">
                                    <span class="font-bold">No Registrasi</span>
                                    <span class="break-words min-w-0">{{ current.no_registrasi }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold">Keluhan Awal</span>
                                    <span class="break-words min-w-0">{{ current.keluhan ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="order-3 md:order-2">
                                <div class="flex flex-col">
                                    <span class="font-bold">Diagnosa</span>
                                    <span class="break-words min-w-0">{{ current.diagnosa ?? '-' }}</span>
                                </div>
                            </div>
                            <div
                                class="order-1 md:order-3 border border-emerald-700 rounded-2xl px-4 py-3 md:px-6 md:py-5 w-fit md:w-auto">
                                <div class="flex items-center gap-3 md:gap-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.8" stroke="currentColor"
                                        class="size-5 md:size-8 text-emerald-800 shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 6h15A1.5 1.5 0 0 1 21 7.5v12A1.5 1.5 0 0 1 19.5 21h-15A1.5 1.5 0 0 1 3 19.5v-12A1.5 1.5 0 0 1 4.5 6Z" />
                                    </svg>
                                    <span class="font-semibold text-base md:text-lg">{{
                                        formatTanggal(current.tanggal_kunjungan) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tindakan & Obat -->
                    <div class="my-4 bg-white rounded-lg shadow overflow-hidden">
                        <h1 class="text-2xl p-4 font-extrabold text-emerald-800">Tindakan</h1>
                        <div class="pl-4 pr-4 pb-4 text-center overflow-x-auto">
                            <table class="table-auto w-full min-w-[400px]">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="py-3 px-4 rounded-l-lg">ID Tindakan</th>
                                        <th class="py-3 px-4">Nama Tindakan</th>
                                        <th class="py-3 px-4 rounded-r-lg">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="current.tindakan.length === 0">
                                        <td colspan="3" class="py-6 text-slate-400">Belum ada tindakan</td>
                                    </tr>
                                    <tr v-for="t in current.tindakan" :key="t.id_tindakan" class="border-b">
                                        <td class="py-3 px-4">{{ t.id_tindakan }}</td>
                                        <td class="py-3 px-4">{{ t.nama_tindakan }}</td>
                                        <td class="py-3 px-4">{{ t.jumlah }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h1 class="text-2xl p-4 font-extrabold text-emerald-800">Obat</h1>
                        <div class="pl-4 pr-4 pb-4 text-center overflow-x-auto">
                            <table class="table-auto w-full min-w-[500px]">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="py-3 px-4 rounded-l-lg">ID Obat</th>
                                        <th class="py-3 px-4">Nama Obat</th>
                                        <th class="py-3 px-4">Jumlah</th>
                                        <th class="py-3 px-4 rounded-r-lg">Aturan Pakai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="current.obat.length === 0">
                                        <td colspan="4" class="py-6 text-slate-400">Belum ada obat</td>
                                    </tr>
                                    <tr v-for="o in current.obat" :key="o.id_obat" class="border-b">
                                        <td class="py-3 px-4">{{ o.id_obat }}</td>
                                        <td class="py-3 px-4">{{ o.nama_obat }}</td>
                                        <td class="py-3 px-4">{{ o.jumlah }}</td>
                                        <td class="py-3 px-4">{{ o.aturan_pakai }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex mt-4 p-4">
                            <button @click="router.visit(route('kwitansi', {
                                no_registrasi: current.no_registrasi,
                                from: 'histori'
                            }))"
                                class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md flex items-center gap-2">
                                Lihat Kwitansi
                            </button>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center gap-2 mt-2 items-center">
                        <button @click="currentPage--" :disabled="currentPage === 1"
                            class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <span class="text-sm text-slate-600 font-medium">
                            Kunjungan {{ currentPage }} dari {{ totalPages }}
                        </span>
                        <button @click="currentPage++" :disabled="currentPage === totalPages"
                            class="w-10 h-10 border border-emerald-800 rounded-xl flex items-center justify-center text-emerald-800 disabled:opacity-40">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                </template>

            </main>
        </div>
    </div>
</template>