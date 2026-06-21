<script setup>
import { ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import NavBar from '@/Components/NavBar.vue'
import SideBar from '@/Components/SideBar.vue'

const props = defineProps({
    pendaftaran: Object,
    tindakan: Array,
    obat: Array,
})

const sidebarOpen = ref(false)

const formatTanggal = (tanggal) => {
    return new Date(tanggal).toLocaleDateString('id-ID', {
        day: 'numeric', month: 'long', year: 'numeric'
    })
}

const formatRupiah = (angka) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency', currency: 'IDR', minimumFractionDigits: 0
    }).format(angka ?? 0)
}
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-slate-100">
        <SideBar :open="sidebarOpen" />
        <div class="flex flex-1 flex-col overflow-hidden">
            <NavBar :open="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
            <main class="flex-1 overflow-y-auto p-8">
                <div class="bg-green-100 rounded-lg p-8 shadow">
                    <h1 class="text-3xl mb-8 font-extrabold text-emerald-800">Keterangan Pasien</h1>
                    <div class="grid grid-cols-3 gap-8">
                        <div>
                            <div class="flex mb-6">
                                <span class="font-bold w-40">No RM</span>
                                <span class="mr-4">:</span>
                                <span>{{ pendaftaran.pasien.no_rm }}</span>
                            </div>
                            <div class="flex mb-6">
                                <span class="font-bold w-40">No Registrasi</span>
                                <span class="mr-4">:</span>
                                <span>{{ pendaftaran.no_registrasi }}</span>
                            </div>
                            <div class="flex">
                                <span class="font-bold w-40">Nama Pasien</span>
                                <span class="mr-4">:</span>
                                <span>{{ pendaftaran.pasien.nama }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex mb-6">
                                <span class="font-bold w-40">Jenis Kelamin</span>
                                <span class="mr-4">:</span>
                                <span>{{ pendaftaran.pasien.jenis_kelamin }}</span>
                            </div>
                            <div class="flex mb-6">
                                <span class="font-bold w-40">TB / BB</span>
                                <span class="mr-4">:</span>
                                <span>
                                    {{ pendaftaran.rekam_medis?.tinggi_badan ?? '-' }} cm /
                                    {{ pendaftaran.rekam_medis?.berat_badan ?? '-' }} kg
                                </span>
                            </div>
                            <div class="flex">
                                <span class="font-bold w-40">Tanggal Lahir</span>
                                <span class="mr-4">:</span>
                                <span>{{ pendaftaran.pasien.tanggal_lahir }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex mb-6">
                                <span class="font-bold w-40">Alamat</span>
                                <span class="mr-4">:</span>
                                <span>{{ pendaftaran.pasien.alamat }}</span>
                            </div>
                            <div class="flex">
                                <span class="font-bold w-40">Kelas BPJS</span>
                                <span class="mr-4">:</span>
                                <span>{{ pendaftaran.pasien.kelas_bpjs }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-4 bg-white rounded-lg shadow overflow-hidden">
                    <h1 class="text-2xl p-4 font-extrabold text-emerald-800">Rincian Tindakan</h1>
                    <div class="pl-4 pr-4 pb-4 text-center">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-3 px-4 rounded-l-lg">ID Tindakan</th>
                                    <th class="py-3 px-4">Nama Tindakan</th>
                                    <th class="py-3 px-4">Jumlah</th>
                                    <th class="py-3 px-4">Harga</th>
                                    <th class="py-3 px-4 rounded-r-lg">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="tindakan.length === 0">
                                    <td colspan="5" class="py-6 text-center text-slate-400">Belum ada tindakan</td>
                                </tr>
                                <tr v-for="item in tindakan" :key="item.id_tindakan" class="border-b">
                                    <td class="py-3 px-4">{{ item.id_tindakan }}</td>
                                    <td class="py-3 px-4">{{ item.nama_tindakan }}</td>
                                    <td class="py-3 px-4">{{ item.jumlah }}</td>
                                    <td class="py-3 px-4">{{ formatRupiah(item.harga) }}</td>
                                    <td class="py-3 px-4">{{ formatRupiah(item.total_harga) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h1 class="text-2xl p-4 font-extrabold text-emerald-800">Rincian Obat</h1>
                    <div class="pl-4 pr-4 pb-4 text-center">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-3 px-4 rounded-l-lg">ID Obat</th>
                                    <th class="py-3 px-4">Nama Obat</th>
                                    <th class="py-3 px-4">Jumlah</th>
                                    <th class="py-3 px-4">Harga</th>
                                    <th class="py-3 px-4 rounded-r-lg">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="obat.length === 0">
                                    <td colspan="5" class="py-6 text-center text-slate-400">Belum ada obat</td>
                                </tr>
                                <tr v-for="item in obat" :key="item.id_obat" class="border-b">
                                    <td class="py-3 px-4">{{ item.id_obat }}</td>
                                    <td class="py-3 px-4">{{ item.nama_obat }}</td>
                                    <td class="py-3 px-4">{{ item.jumlah }}</td>
                                    <td class="py-3 px-4">{{ formatRupiah(item.harga) }}</td>
                                    <td class="py-3 px-4">{{ formatRupiah(item.total_harga) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end mt-4 p-4">
                        <button @click="router.visit(route('kwitansi', { no_registrasi: pendaftaran.no_registrasi }))"
                            class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md flex items-center gap-2">
                            Lihat Kwitansi
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>